<?php

namespace Asvae\LaravelFixtures\Examples\Articles;

class FillArticlesTable extends \Asvae\LaravelFixtures\AbstractFixture
{
    /**
     * Move articles from articles to articles_new table.
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('articles_new')->truncate();

        $count = \DB::table('articles')->count();

        $this->getCommand()->line('Total ads: '.$count);

        \DB::table('articles')->chunk(500, function ($ads) {
            foreach ($ads as $ad) {
                $this->createOne($ad);
                $this->counter++;
            }

            $this->getCommand()->line($this->counter);
        });
    }

    protected function createOne($ad)
    {
        \DB::table('articles_new')->insert([
            'id'               => $ad->id,
            'user_id'          => $ad->user_id,
            'project_id'       => $ad->project_id,
            'currency_id'      => $ad->currency,
            'title'            => $ad->ad_name,
            'body'             => $ad->ad_desc,
            'created_at'       => $ad->create_date,
            'updated_at'       => $ad->create_date,
            'country_id'       => $ad->country,
        ]);
    }
}