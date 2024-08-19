<?php
namespace App\Traits;

use App\Models\Metatag;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
trait SeoCustomize{
    public function setupSeoWithoutModel($page){
        if($page=='allPosts'){
            $metaTag= Metatag::where('model_type','LIKE','%Allposts%')->first();
        }elseif($page=='allProducts'){
            $metaTag= Metatag::where('model_type','LIKE','%Allproducts%')->first();
        }
        // canonical setup
        $canonicalUrl = url()->current();
        SEOMeta::setCanonical($canonicalUrl);

        // setup SEO tags from metadata or default value if not exist metadata
        SEOMeta::setTitle($metaTag->title);
        SEOMeta::setDescription($metaTag->description);
        SEOMeta::addKeyword($metaTag->keyword ?? 'ban hat giong, mua hat giong, cung cap hat giong');
        SEOMeta::addMeta('author', $metaTag->author ?? 'hatgiong');
        $robots = $metaTag->robots;
        SEOMeta::addMeta('robots', $robots);
        SEOMeta::addMeta('locale', $metaTag->locale ?? 'vi_VN');

        // setup OpenGraph
        $this->setupOpenGraph(null, $metaTag);

        // // setup Twitter Card
        $this->setupTwitter(null, $metaTag);

        // // setup JSON-LD
        $this->setupJsonLd(null, $metaTag);

    }
    public function setupSeoWithModel($model){
        // get metatag from eloquent relationship
        $metaTag =  $model->metatag;
        // Determine if the current URL is a canonical or a supplementary URL
        $isSupplementaryUrl = $this->isSupplementaryUrl($model);
        // canonical setup
        $canonicalUrl = $this->getCanonicalUrl($model);
        SEOMeta::setCanonical($canonicalUrl);

        // setup SEO tags from metadata or default value if not exist metadata
        SEOMeta::setTitle($metaTag->title ?? $model->name);
        SEOMeta::setDescription($metaTag->description ?? $model->short_description);
        SEOMeta::addKeyword($metaTag->keyword ?? 'ban hat giong, mua hat giong, cung cap hat giong');
        SEOMeta::addMeta('author', $metaTag->author ?? 'hatgiong');
        if($metaTag && $metaTag->robots && str_contains($metaTag->robots,'index')){
            $robots = $metaTag->robots;
        }else{
            $robots = $isSupplementaryUrl ? 'noindex,follow' : 'index,follow';
        }
        SEOMeta::addMeta('robots', $robots);
        SEOMeta::addMeta('locale', $metaTag->locale ?? 'vi_VN');

        // setup OpenGraph
        $this->setupOpenGraph($model, $metaTag);

        // setup Twitter Card
        $this->setupTwitter($model, $metaTag);

        // setup JSON-LD
        $this->setupJsonLd($model, $metaTag);

        // $thumbUrl='';
        // $seoType='';
        // $metatag='';
        // $imageCollection='*';
        // switch (get_class($model)) {
        //     case 'App\Models\Post':
        //         $modelType ='post';
        //         $seoType ='articles';
        //         $imageCollection ='posts';
        //         break;
        //     case 'App\Models\Product':
        //         $modelType ='product';
        //         $seoType ='product';
        //         $imageCollection ='products';
        //         break;
        //     default:
        //         $modelType ='';
        //         $seoType='';
        //   }
        // if($metatag = $model->metatag){
        //     // if($modelType=='product'){
        //     //     $thumbUrl = $model->getFirstMedia()?$model->getFirstMedia()->getUrl('thumb'):'';
        //     // }else{
        //     //     $thumbUrl = $model->getFirstMedia($modelType)?$model->getFirstMedia($modelType)->getUrl('thumb'):'';
        //     // }
        //     SEOMeta::setTitle($metatag->title??$metatag->name);
        //     SEOMeta::setDescription($metatag->description);
        //     SEOMeta::setKeywords($metatag->keyword);

        //     OpenGraph::setDescription($metatag->description);
        //     OpenGraph::setTitle($metatag->title);

        //     TwitterCard::setTitle($metatag->title);

        //     JsonLd::setTitle($metatag->title);
        //     JsonLd::setDescription($metatag->description);


        // }
        // // SEOMeta::setTitle($metatag->title??$metatag->name);
        // // SEOMeta::setDescription($metatag->description);
        // // SEOMeta::setKeywords($metatag->keyword);
        // SEOMeta::setCanonical(url()->current());

        // // OpenGraph::setDescription($metatag->description);
        // // OpenGraph::setTitle($metatag->title);
        // OpenGraph::setUrl(url()->current());
        // OpenGraph::addProperty('type', $seoType);
        // OpenGraph::addProperty('locale', 'vi_VN');
        // OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        // // OpenGraph::addImage($thumbUrl);
        // // OpenGraph::addImage($model->get);
        // // if($listImageUrl!=''){
        // //     OpenGraph::addImage($listImageUrl);
        // // }
        // $images = $model->getMedia($imageCollection);
        // foreach ($images as $image) {
        //     $imageUrl = $image->getUrl('og-image');
        //     OpenGraph::addImage($imageUrl);
        // }
        // // OpenGraph::addImage(['url' => "{{$product->getFirstMedia()->getUrl('medium')}}", 'size' => 300]);
        // // OpenGraph::addImage("{{$product->getFirstMedia()->getUrl('large')}}", ['height' => 400, 'width' => 400]);

        // // TwitterCard::setTitle($metatag->title);
        // TwitterCard::setSite(route('home'));
        // // Twitter usualy take only one first image
        // TwitterCard::setImage($model->getFirstImageUrl('og-image'));

        // // JsonLd::setTitle($metatag->title);
        // // JsonLd::setDescription($metatag->description);
        // JsonLd::setType($seoType);
        // if($thumbUrl
        // ){
        //     JsonLd::addImage($thumbUrl);
        // }
    }




    protected function setupOpenGraph($model=null, $metaTag)
    {
        if($model!=null){
            // Determine OpenGraph type
            $type = $this->determineSeoType($model);
            // Thiết lập thuộc tính OpenGraph type
            OpenGraph::addProperty('type', $type);
            // Thiết lập các thuộc tính OpenGraph khác từ metadata hoặc giá trị mặc định
            OpenGraph::setTitle($metaTag->title ?? $model->name??$model->title);
            OpenGraph::setDescription($metaTag->description ?? $model->description);
            OpenGraph::setUrl($this->getCanonicalUrl($model));

            OpenGraph::addProperty('locale', 'vi_VN');
            OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
            // OpenGraph::addProperty('image', $model->getImageUrl()); // Gọi hình ảnh từ phương thức model
            $mediaCollection = $this->getImageCollection($model);
            $images = $model->getMedia($mediaCollection);
            foreach ($images as $image) {
                $imageUrl = $image->getUrl('og-image');
                OpenGraph::addImage($imageUrl);
            }
        }else{
            // Thiết lập các thuộc tính OpenGraph khác từ metadata hoặc giá trị mặc định
            OpenGraph::setTitle($metaTag->title );
            OpenGraph::setDescription($metaTag->description);
            OpenGraph::setUrl(url()->current());

            OpenGraph::addProperty('locale', 'vi_VN');
            OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
            // OpenGraph::addProperty('image', $model->getImageUrl()); // Gọi hình ảnh từ phương thức model
            // $mediaCollection = $this->getImageCollection($model);
            // $images = $model->getMedia($mediaCollection);
            // foreach ($images as $image) {
            //     $imageUrl = $image->getUrl('og-image');
            //     OpenGraph::addImage($imageUrl);
            // }
        }

    }
    protected function setupTwitter($model=null, $metaTag)
    {
        if($model!=null){
            TwitterCard::setTitle($metaTag->title ?? $model->name??$model->title);
            TwitterCard::setDescription($metaTag->description ?? $model->short_description);
            TwitterCard::setImage($model->getFirstImageUrl('og-image')??$model->getFirstImageUrl('thumb')); // Get image from model method
        }else{
            TwitterCard::setTitle($metaTag->title);
            TwitterCard::setDescription($metaTag->description);
            // TwitterCard::setImage($model->getFirstImageUrl('og-image')??$model->getFirstImageUrl('thumb')); // Get image from model method
        }


    }

    /**
     * Setup JSON-LD meta tags for the given model.
     *
     * @param  mixed  $model
     * @param  mixed  $metaTag
     * @return void
     */
    protected function setupJsonLd($model=null, $metaTag)
    {
        if($model!=null){
            $type = $this->determineSeoType($model);
            JsonLd::setTitle($metaTag->title ?? $model->name??$model->title);
            JsonLd::setDescription($metaTag->description ?? $model->short_description);
            JsonLd::setType($type); // Set appropriate JSON-LD type
            JsonLd::addValue('url', $this->getCanonicalUrl($model));
            // JsonLd::addValue('image', $model->getImageUrl()); // Get image from model method
            $thumbUrl = $model->getFirstMedia("*")?$model->getFirstMedia("*")->getUrl('thumb'):'';
            if($thumbUrl){
                JsonLd::addImage($thumbUrl);
            }
        }else{

            JsonLd::setTitle($metaTag->title);
            JsonLd::setDescription($metaTag->description);
            JsonLd::addValue('url', url()->current());
            // JsonLd::addValue('image', $model->getImageUrl()); // Get image from model method
            // $thumbUrl = $model->getFirstMedia("*")?$model->getFirstMedia("*")->getUrl('thumb'):'';
            // if($thumbUrl){
            //     JsonLd::addImage($thumbUrl);
            // }
        }

    }

     // Get the canonical URL for the given model.
     protected function getCanonicalUrl($model)
     {
        if ($model instanceof \App\Models\Product) {
            if ($model->category) {
                return route('products.category.show', [$model->category, $model]);
            }
            return route('products.show', [$model->slug]);
        }
        if ($model instanceof \App\Models\Post) {
            if ($model->pcategory) {
                // Generate URL for post with categories
                return route('posts.withCategory.show', [
                    $this->getCategorySlugs($model->pcategory),
                    $model->slug
                ]);
            } else {
                // Generate URL for post without categories
                return route('posts.withoutCategory.show', [$model->slug]);
            }
        }

        // elseif ($model instanceof \App\Models\Post) {
        //     if ($model->pcategory) {
        //         return route('posts.pcategory.show', [$model->pcategory, $model]);
        //     }
        //     return route('posts.show', [$model]);
        // }
        return url()->current();
     }
    /**
     * Determine the SEO type for the given model.
     *
     * @param  mixed  $model
     * @return string
     */
    protected function determineSeoType($model)
    {
        // Example: determine type based on the class of the model
        if ($model instanceof \App\Models\Product) {
            return 'Product'; // Corresponding type for JSON-LD and OpenGraph
        }
        elseif ($model instanceof \App\Models\Post) {
            return 'Article';
        }
        //elseif ($model instanceof \App\Models\Event) {
        //     return 'Event';
        // } elseif ($model instanceof \App\Models\LocalBusiness) {
        //     return 'LocalBusiness';
        // } elseif ($model instanceof \App\Models\Person) {
        //     return 'Person';
        // } elseif ($model instanceof \App\Models\Recipe) {
        //     return 'Recipe';
        // } elseif ($model instanceof \App\Models\Review) {
        //     return 'Review';
        // } elseif ($model instanceof \App\Models\Video) {
        //     return 'VideoObject';
        // } elseif ($model instanceof \App\Models\Book) {
        //     return 'Book';
        // }

        // Default
        return 'WebPage';
    }
    protected function getCategorySlugs($category)
    {
        // Get slugs of all ancestor categories and join them with '/'
        $ancestorSlugs = $category->ancestors()->pluck('slug')->implode('/');

        // Include the current category slug
        return $ancestorSlugs ? $ancestorSlugs . '/' . $category->slug : $category->slug;
    }
    protected function getImageCollection($model){
        if ($model instanceof \App\Models\Product) {
            return 'products';
        }
        elseif ($model instanceof \App\Models\Post) {
            return 'posts';
        }
        elseif ($model instanceof \App\Models\Category) {
            return 'categories';
        }
        elseif ($model instanceof \App\Models\Pcategory) {
            return 'postscategories';
        }

        return '';
    }
    /**
     * Determine if the current URL is a supplementary URL.
     *
     * @return bool
     */
    protected function isSupplementaryUrl($model)
    {
        // Check the current route name
        $routeName = request()->route()->getName();

        // If the product has a category and the current route is not the category route
        if ($model->category && $routeName !== 'products.category.show') {
            return true; // This is a supplementary URL
        }
        // If the post has a category and the current route is not the category route
        if ($model->pcategory && $routeName !== 'products.pcategory.show') {
            return true; // This is a supplementary URL
        }

        // If the product does not have a category and the current route is not the product route
        // if (!$model->category && $routeName !== 'products.show') {
        //     return true; // This is a supplementary URL
        // }

        return false; // This is the main URL
    }
}
