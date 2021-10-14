<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CategoryHasSubCategory extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_category_has_many_subcategories()
    {
        $category = new Category;
        $this->assertInstanceOf(Collection::class, $category->subcategory);
    }
}
