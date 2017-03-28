<?php

namespace App\Transformers;
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 09/01/16
 * Time: 2:40 PM
 */
abstract class Transformer
{

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public function transformPaginatedCollection($items)
    {
        $collection = $this->transformCollection($items->items());

        $response['data'] = $collection;
        $response['per_page'] = $items->perPage();
        $response['current_page'] = $items->currentPage();
        $response['next_page_url'] = $items->nextPageUrl();

        return $response;
    }

    public abstract function transform($item);
}