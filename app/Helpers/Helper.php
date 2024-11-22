<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper 
 {
    public static function active($active=0): string
    {
      return $active==0 ? '<span class="btn btn-danger btn-xs">No</span>' : 
                           '<span class="btn btn-success btn-xs">Yes</span>';
    }

    public static function status($status=0): string
    {
      return $status==0 ? '<span class="btn btn-danger btn-xs">Chờ duyệt</span>' : 
                           '<span class="btn btn-success btn-xs">Hoạt động</span>';
    }

    public static function isChild($productCategories, $id) : bool
   {
      foreach($productCategories as $k => $productCategory)
      {
         if($productCategory->parent_id==$id)
         {
            return true;
         }
      }
      return false;
   }

   public static function productCategories($productCategories, $parent_id = 0): string
  {
      $html = '';

      foreach ($productCategories as $key => $productCategory) {
          if ($productCategory->parent_id == $parent_id) {
              $html .= '
                  <li class="">
                      <a href="/danh-muc/' . $productCategory->id . '-' . Str::slug($productCategory->name, '-') . '.html">
                          ' . $productCategory->name;

              if (self::isChild($productCategories, $productCategory->id)) {
                  $html .= '<i class="fa fa-angle-right" aria-hidden="true"></i>';
              }

              $html .= '</a>';

              unset($productCategories[$key]);

              if (self::isChild($productCategories, $productCategory->id)) {
                  $html .= '<ul class="ht-dropdown mega-child">';
                  $html .= self::productCategories($productCategories, $productCategory->id);
                  $html .= '</ul>';
              }

              $html .= '</li>';
          }
      }

      return $html;
  }

  public static function postCategories($postCategories, $parent_id =0) : string
  {
     $html='';
        foreach($postCategories as $key => $postCategory)
           {
              if($postCategory->parent_id==$parent_id) {
                 $html.='
                    <li class=""><a href="/danh-muc-bai-viet/' . $postCategory->id . '-' . Str::slug($postCategory->name,'-') . '.html">
                          ' . $postCategory->name . '
                                </a>';
                       unset($postCategories[$key]);
                       if(self::isChildPost($postCategories, $postCategory->id))
                       {
                          $html .= '<ul class="ht-dropdown dropdown-style-two">';
                          $html .= self::postCategories($postCategories, $postCategory->id);
                          $html .= '</ul>';
                       }
                    $html.='</li>
                 ';
              }
           }
     return $html;
  }

   public static function isChildPost($postCategories, $id) : bool
  {
     foreach($postCategories as $k => $postCategory)
     {
        if($postCategory->parent_id==$id)
        {
           return true;
        }
     }
     return false;
  }


}