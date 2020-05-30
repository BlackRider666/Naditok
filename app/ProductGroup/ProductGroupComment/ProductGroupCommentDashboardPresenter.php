<?php


namespace App\ProductGroup\ProductGroupComment;


use App\Core\DashboardPresenter;
use App\ProductGroup\ProductGroup;
use Illuminate\Database\Eloquent\Collection;

class ProductGroupCommentDashboardPresenter
{
    public function getTablePage(Collection $comments)
    {
        $headers = [
            'author'            =>  'Author',
            'rating'            =>  'Rating',
            'product_group_id'  =>  'Product Group',
        ];
        $name = 'comments';
        return (new DashboardPresenter())->getTablePage($headers, $name, $comments);
    }

    public function getShowPage(ProductGroupComment $comment)
    {
        $header = $comment->author;
        $fields = [
            'product_group_id'  =>  'Product Group',
            'rating'            =>  'Rating',
            'author'            =>  'Author',
            'comment'           =>  'Comment',

        ];
        return (new DashboardPresenter())->getShowPage($header, $comment, $fields);
    }

    public function getCreatePage()
    {
        $casts = (new ProductGroupComment())->getCasts();
        unset($casts['id']);
        $name = 'comments';
        $options = [
            'product_group_id'    =>  ProductGroup::all()->toArray(),
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(ProductGroupComment $comment)
    {
        $name = 'comments';
        $fields = [
            'rating',
            'comment',
        ];
        return (new DashboardPresenter())->getEditPage($comment,$name,$fields);
    }
}
