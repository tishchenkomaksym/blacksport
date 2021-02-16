<?php


namespace App\Services;


class NewsService
{
    public function checkCreatedAt(&$news)
    {
        // $news = News::select(DB::raw('id, title, description, images, published,
        //                IF(hide_date = 0, created_at,null) as created_at, IF(hide_date = 0, updated_at,null) as updated_at'))
        //            ->orderByDesc('created_at')->get();
        foreach ($news as $key => $item){
            if ($item->hide_date == 1){
                $news[$key]->created_at = null;
                $news[$key]->updated_at = null;
            }
        }

    }
}
