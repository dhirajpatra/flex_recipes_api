<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{

    private $recipes;
    private $ingredients;

    public function __construct()
    {
        // createing recipes array from json file require for both phpunit and application
        if (!file_exists('src/App/Recipe/data.json')) {
            $recipe_list = file_get_contents(APP_ROOT . '/src/App/Recipe/data.json');
        } else {
            $recipe_list = file_get_contents('src/App/Recipe/data.json');
        }

        $this->recipes = json_decode($recipe_list, true)['recipes'];

        // creating ingredients file from json require for both phpunit and application
        if (!file_exists('src/App/Ingredient/data.json')) {
            $ingredient_list = file_get_contents(APP_ROOT . '/src/App/Ingredient/data.json');
        } else {
            $ingredient_list = file_get_contents('src/App/Ingredient/data.json');
        }

        $this->ingredients = json_decode($ingredient_list, true)['ingredients'];
    }

    /**
     * @Route("/api/lunch/{best_before}/{use_by}")
     * @Method("GET")
     */
    public function index($best_before, $use_by)
    {
        try {
            if ($use_by != null && $best_before != null) {

                if (\DateTime::createFromFormat('Y-m-d', $use_by) !== false && \DateTime::createFromFormat('Y-m-d', $best_before) !== false) {

                    $fresh_ingredients = [];
                    $only_fresh_ingredients = [];

                    foreach ($this->ingredients as $ingredient) {
                        // check they are fresh as per conditions
                        if (($ingredient['use-by'] > $use_by) || ($ingredient['use-by'] >= $use_by && $ingredient['best-before'] >= $best_before)) {
                            $fresh_ingredients[] = $ingredient;
                            $only_fresh_ingredients[] = $ingredient['title'];
                        }
                    }

                    $result = $this->checkRecipe($only_fresh_ingredients);

                    // sort the recipes based on its freshness
                    foreach ($fresh_ingredients as $key => $row) {
                        $selected_ingredients[$key] = $row['best-before'];
                    }
                    array_multisort($selected_ingredients, SORT_DESC, $fresh_ingredients);
                    $this->ingredients = $fresh_ingredients;

                    $previous_avg = 0;
                    $sorted_result = [];
                    foreach ($result as $value) {
                        $total = 0;
                        $avg = 0;
                        $cnt = 0;
                        // calculate position value total and avg
                        foreach ($value['ingredients'] as $ingredient) {
                            $total += $this->find_position_ingredients($ingredient);
                            $cnt++;
                        }
                        // avg of positional values as per freshness less avg more fresh
                        $avg = $total / $cnt;

                        // checking which one is fresher compared to last one
                        if ($previous_avg != 0 && $previous_avg < $avg) {
                            // swapping the sub array with current one and previous one
                            $temp = $sorted_result[(count($sorted_result) - 1)];
                            $sorted_result[(count($sorted_result) - 1)] = $value;
                            $sorted_result[] = $temp;
                        } else {
                            $sorted_result[] = $value;
                        }
                        $previous_avg = $avg;
                    }

                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return new JsonResponse(
                [
                    'status' => 400,
                    'recipes' => [],
                ]
            );
        }

        return new JsonResponse(
            [
                'status' => 200,
                'recipes' => $sorted_result,
            ]
        );
    }

    /**
     * this function will find out which recipes are possible with the given ingredintes
     *
     * @param array $fresh_ingredients
     * @return array
     */
    private function checkRecipe($fresh_ingredients)
    {
        $result = [];
        try {
            foreach ($this->recipes as $name => $details) {
                // if all ingredients present in my fridge for this recipe
                $diff = array_diff($details['ingredients'], $fresh_ingredients);
                if (empty($diff)) {
                    // $result[] = $details['title'];
                    $result[] = $details;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }

        return $result;
    }

    /**
     * find the position value for a fresh ingredients in its sorted array
     *
     * @param [type] $ingredient
     * @return void
     */
    private function find_position_ingredients($ingredient)
    {
        try {
            foreach ($this->ingredients as $key => $value) {
                if ($ingredient == $value['title']) {
                    return $key;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }
}