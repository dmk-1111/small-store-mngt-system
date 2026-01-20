<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Product;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('No'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'));
        $grid->column('image', __('Image'))->display(function ($image) {
            return $image ? "<img src='" . asset('uploads/' . $image) . "' width='50' height='50' />" : '';
        });
        $grid->column('created_by', __('Created by'))->display(function(){
            return $this->CreatedByName;
        });
        $grid->column('updated_by', __('Updated by'))->display(function(){
            return $this->UpdatedByName;
        });
        $grid->column('created_at', __('Created at'))->display(function($createdAt){
            return dateAndTimeFormat($createdAt);
        });
        $grid->column('updated_at', __('Updated at'))->display(function($updatedAt){
            return dateAndTimeFormat($updatedAt);
        });

        $grid->filter(function (Grid\Filter $filter) {
            $filter->like('name', 'Name');
            $filter->between('price', 'Price');
            $filter->between('created_at', 'Created at')->datetime();
        });

        $grid->quickSearch('name', 'description','price');

        $grid->disableExport();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $product = Product::find($id);
        return view('admin.components.product.show', compact('product'));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());
        $form->column(1/2, function (Form $form) {
            $form->text('name', __('Name'))->rules('required|min:3');
            $form->textarea('description', __('Description'))->rows(2);
        });
        $form->column(1/2, function (Form $form) {
                $form->decimal('price', __('Price'))->rules('required');
            $form->file('image', __('Image'))->rules('mimes:jpg,png,jpeg');
        });
        return $form;
    }
}
