<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PostCategory;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\PostCategory\PostCategoryService;

use LDAP\Result;

class PostCategoryController extends Controller
{
    protected $postCategoryService;

    public function __construct(PostCategoryService $postCategoryService)
    {
        $this->postCategoryService = $postCategoryService;
    }

    public function add()
    {
        return view('admin.postcategories.add',[
            'title' => 'Add new category',
            'postCategories' => $this->postCategoryService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result=$this->postCategoryService->store($request);
        if($result){
            return redirect()->route('post_categories.list');
        }
        return redirect()->back();
    }

    public function list()
    {
        return view('admin.postcategories.list',[
            'title' => 'List of categories',
            'postCategories' => $this->postCategoryService->list()
        ]);
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.postcategories.edit',[
            'title' => 'Edit category ' .$postCategory->name,
            'postCategory' => $postCategory,
            'postCategories' => $this->postCategoryService->getParent()
           
        ]);
    }

    public function update (PostCategory $postCategory,CreateFormRequest $request)
    {
        $this->postCategoryService->update($request, $postCategory);
        return redirect()->route('post_categories.list');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->postCategoryService->destroy($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Category deleted successfully'
            ]);
        }
        return response()->json([
            'error' => true
           
        ]);
    }
}   
