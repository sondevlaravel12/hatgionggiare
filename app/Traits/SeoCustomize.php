<?php
namespace App\Traits;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
trait SeoCustomize{
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




    protected function setupOpenGraph($model, $metaTag)
    {
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
    }
    protected function setupTwitter($model, $metaTag)
    {
        TwitterCard::setTitle($metaTag->title ?? $model->name??$model->title);
        TwitterCard::setDescription($metaTag->description ?? $model->short_description);
        TwitterCard::setImage($model->getFirstImageUrl('og-image')??$model->getFirstImageUrl('thumb')); // Get image from model method

    }

    /**
     * Setup JSON-LD meta tags for the given model.
     *
     * @param  mixed  $model
     * @param  mixed  $metaTag
     * @return void
     */
    protected function setupJsonLd($model, $metaTag)
    {
        $type = $this->determineSeoType($model);

        JsonLd::setTitle($metaTag->title ?? $model->name);
        JsonLd::setDescription($metaTag->description ?? $model->short_description);
        JsonLd::setType($type); // Set appropriate JSON-LD type
        JsonLd::addValue('url', $this->getCanonicalUrl($model));
        // JsonLd::addValue('image', $model->getImageUrl()); // Get image from model method
        $thumbUrl = $model->getFirstMedia("*")?$model->getFirstMedia("*")->getUrl('thumb'):'';
        if($thumbUrl){
            JsonLd::addImage($thumbUrl);
        }
    }

     // Get the canonical URL for the given model.
     protected function getCanonicalUrl($model)
     {
         // Kiểm tra nếu model có category
         if (method_exists($model, 'category') && $model->category) {
             return route('products.category.show', [$model->category->slug, $model->slug]);
         }
         // Trường hợp không có category
         return route('products.show', [$model->slug]);
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

        // If the product does not have a category and the current route is not the product route
        // if (!$model->category && $routeName !== 'products.show') {
        //     return true; // This is a supplementary URL
        // }

        return false; // This is the main URL
    }
}
