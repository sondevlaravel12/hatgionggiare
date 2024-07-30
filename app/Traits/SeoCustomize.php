<?php
namespace App\Traits;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
trait SeoCustomize{
    public function setupSeo($metatag, $type='product', $imageUrl='', $listImageUrl=''){

        SEOMeta::setTitle($metatag->title);
        SEOMeta::setDescription($metatag->description);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($metatag->description);
        OpenGraph::setTitle($metatag->title);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', $type);
        OpenGraph::addProperty('locale', 'vi_VN');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        OpenGraph::addImage($imageUrl);
        if($listImageUrl!=''){
            OpenGraph::addImage($listImageUrl);
        }
        //
        // OpenGraph::addImage(['url' => "{{$product->getFirstMedia()->getUrl('medium')}}", 'size' => 300]);
        // OpenGraph::addImage("{{$product->getFirstMedia()->getUrl('large')}}", ['height' => 400, 'width' => 400]);

        TwitterCard::setTitle($metatag->title);
        TwitterCard::setSite(route('home'));

        JsonLd::setTitle($metatag->title);
        JsonLd::setDescription($metatag->description);
        JsonLd::setType($type);
        //if($imageUrl){
            JsonLd::addImage($imageUrl);
        //}
    }
    public function setupSeoWithModel($model){
        $thumbUrl='';
        $modelType ='';
        $seoType='';
        $metatag='';
        $imageCollection='*';
        $listImageUrl= '';
        switch (get_class($model)) {
            case 'App\Models\Post':
                $modelType ='post';
                $seoType ='articles';
                $imageCollection ='posts';
                break;
            case 'App\Models\Product':
                $modelType ='product';
                $seoType ='product';
                $imageCollection ='products';
                break;
            default:
                $modelType ='';
                $seoType='';
          }
        if($metatag = $model->metatag){
            // if($modelType=='product'){
            //     $thumbUrl = $model->getFirstMedia()?$model->getFirstMedia()->getUrl('thumb'):'';
            // }else{
            //     $thumbUrl = $model->getFirstMedia($modelType)?$model->getFirstMedia($modelType)->getUrl('thumb'):'';
            // }
            SEOMeta::setTitle($metatag->title??$metatag->name);
            SEOMeta::setDescription($metatag->description);
            SEOMeta::setKeywords($metatag->keyword);

            OpenGraph::setDescription($metatag->description);
            OpenGraph::setTitle($metatag->title);

            TwitterCard::setTitle($metatag->title);

            JsonLd::setTitle($metatag->title);
            JsonLd::setDescription($metatag->description);


        }
        // SEOMeta::setTitle($metatag->title??$metatag->name);
        // SEOMeta::setDescription($metatag->description);
        // SEOMeta::setKeywords($metatag->keyword);
        SEOMeta::setCanonical(url()->current());

        // OpenGraph::setDescription($metatag->description);
        // OpenGraph::setTitle($metatag->title);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', $seoType);
        OpenGraph::addProperty('locale', 'vi_VN');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        // OpenGraph::addImage($thumbUrl);
        OpenGraph::addImage($model->get);
        // if($listImageUrl!=''){
        //     OpenGraph::addImage($listImageUrl);
        // }
        $images = $model->getMedia($imageCollection);
        foreach ($images as $image) {
            $imageUrl = $image->getUrl('og-image');
            OpenGraph::addImage($imageUrl);
        }
        // OpenGraph::addImage(['url' => "{{$product->getFirstMedia()->getUrl('medium')}}", 'size' => 300]);
        // OpenGraph::addImage("{{$product->getFirstMedia()->getUrl('large')}}", ['height' => 400, 'width' => 400]);

        // TwitterCard::setTitle($metatag->title);
        TwitterCard::setSite(route('home'));
        // Twitter usualy take only one first image
        TwitterCard::setImage($model->getFirstImageUrl('og-image'));

        // JsonLd::setTitle($metatag->title);
        // JsonLd::setDescription($metatag->description);
        JsonLd::setType($seoType);
        if($thumbUrl){
            JsonLd::addImage($thumbUrl);
        }
    }
}
