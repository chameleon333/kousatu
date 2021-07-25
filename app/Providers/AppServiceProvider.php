<?php

namespace App\Providers;

use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Collection $collection)
    {
        View::share('keyword', '');
        $this->addCollectionMacro($collection);
    }

    /**
     * Collectionのマクロ
     * @param Collection $collection
     * @return void
     */
    public function addCollectionMacro(Collection $collection)
    {

        /**
         *
         */
        $collection->macro("rankBy", function (string $key, bool $addRank = true) {
            return $this->sortByDesc($key)
                ->values()
                ->map(function ($item, $index) use ($key, $addRank) {
                    if (!isset($item[$key])) {
                        throw new Exception('values used in ranking must not be null.');
                    }

                    if ($addRank) {
                        $item["rank"] = $index + 1;
                    }

                    return $item;
                });
        });


        /**
         * Collectionに対して paginate できるようにするマクロ
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        $collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
