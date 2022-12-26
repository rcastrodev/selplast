<?php

use App\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/', 'PagesController@home')->name('index');
Route::get('/empresa', 'PagesController@empresa')->name('empresa');
Route::get('/categorias', 'PagesController@categorias')->name('categorias');
Route::get('/categoria/{id}', 'PagesController@categoria')->name('categoria');
Route::get('/sub-categoria/{id}', 'PagesController@subCategoria')->name('subCategoria');
Route::get('/aplicaciones', 'PagesController@aplicaciones')->name('aplicaciones');
Route::get('/industrias', 'PagesController@industrias')->name('industrias');
Route::get('/industria/{id}', 'PagesController@industria')->name('industria');
Route::get('/calidad', 'PagesController@calidad')->name('calidad');
Route::get('/novedades', 'PagesController@novedades')->name('novedades');
Route::get('/novedad/{id}', 'PagesController@novedad')->name('novedad');
Route::get('/contacto', 'PagesController@contacto')->name('contacto');
Route::post('enviar-contacto', 'MailController@contact')->name('send-contact');
Route::get('/descargar-archivo/{id}/{reg}', 'ContentController@descargarArchivo')->name('descargar-archivo');
Route::get('/descargar-certificado/{id}', 'CertificateController@descargarCertificado')->name('descargar-certificado');

Route::middleware('auth')->prefix('admin')->group(function () {
    /** Page Home */
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('home/content', 'HomeController@content')->name('home.content');
    Route::post('home/content/generic-section/store', 'HomeController@store')->name('home.content.store');
    Route::post('home/content/generic-section/update', 'HomeController@update')->name('home.content.update');
    Route::post('home/content/update', 'HomeController@updateSection')->name('home.content.update-section');
    Route::delete('home/content/{id}', 'HomeController@destroy')->name('home.content.destroy');
    Route::get('home/content/slider/get-list', 'HomeController@sliderGetList')->name('home.slider.get-list');
    /** Fin home*/

    /** Page Company */
    Route::get('company/content', 'CompanyController@content')->name('company.content');
    Route::post('company/content/store-slider', 'CompanyController@storeSlider')->name('company.content.storeSlider');
    Route::post('company/content/update-slider', 'CompanyController@updateSlider')->name('company.content.updateSlider');
    Route::post('company/qualities/store', 'CompanyController@createInfo')->name('company.info.store');
    Route::post('company/content/update-info', 'CompanyController@updateInfo')->name('company.content.updateInfo');
    Route::post('company/content/generic-section/update', 'CompanyController@updateHomeGenericSection')->name('company.content.generic-section.update');
    Route::delete('company/content/{id}', 'CompanyController@destroySlider')->name('company.content.destroy');
    Route::get('company/content/slider/get-list', 'CompanyController@sliderGetList')->name('company.slider.get-list');
    Route::get('company/content/service/get-list', 'CompanyController@serviceGetList')->name('company.service.get-list');
    /** Fin company*/

    /** Page Brand */
    Route::get('brand/content', 'BrandController@content')->name('brand.content');
    Route::post('brand/content/generic-section/store', 'BrandController@store')->name('brand.content.store');
    Route::post('brand/content/generic-section/update', 'BrandController@update')->name('brand.content.update');
    Route::post('brand/content/update', 'BrandController@updateSection')->name('brand.content.update-section');
    Route::delete('brand/content/{id}', 'BrandController@destroy')->name('brand.content.destroy');
    Route::get('brand/content/{id}', 'BrandController@find')->name('brand.content.find');
    Route::get('brand/content/slider/get-list', 'BrandController@sliderGetList')->name('brand.slider.get-list');
    /** Fin Brand*/

    /** Page Category */
    Route::get('category/content', 'CategoryController@content')->name('category.content');
    Route::get('category/create', 'CategoryController@create')->name('category.content.create');
    Route::post('category/store', 'CategoryController@store')->name('category.content.store');
    Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.content.edit');
    Route::post('category/update/{id}', 'CategoryController@update')->name('category.content.update');
    Route::delete('category/content/{id}', 'CategoryController@destroy')->name('category.content.destroy');
    Route::get('category/content/get-list', 'CategoryController@getList')->name('category.slider.get-list');
    Route::get('category/content/get-images/{id}', 'CategoryController@imagesCategory')->name('category.slider.get-images');
    Route::post('category/images/store', 'CategoryController@imagesStore')->name('category.images.store');
    Route::post('category/images/update', 'CategoryController@imagesUpdate')->name('category.images.update');
    Route::get('category/content/image-category/{id?}', 'CategoryController@findImageCategory');
    Route::delete('category/content/image/{id}', 'CategoryController@imageDestroy')->name('category.image.destroy');
    /** Fin Category*/

    /** Page Category */
    Route::get('subcategory/content', 'SubCategoryController@content')->name('subcategory.content');
    Route::get('subcategory/create', 'SubCategoryController@create')->name('subcategory.content.create');
    Route::post('subcategory/store', 'SubCategoryController@store')->name('subcategory.content.store');
    Route::get('subcategory/edit/{id}', 'SubCategoryController@edit')->name('subcategory.content.edit');
    Route::post('subcategory/update/{id}', 'SubCategoryController@update')->name('subcategory.content.update');
    Route::delete('subcategory/content/{id}', 'SubCategoryController@destroy')->name('subcategory.content.destroy');
    Route::get('subcategory/content/get-list', 'SubCategoryController@getList')->name('subcategory.slider.get-list');
    Route::get('subcategory/content/get-images/{id}', 'SubCategoryController@imagesCategory')->name('subcategory.slider.get-images');
    Route::post('subcategory/images/store', 'SubCategoryController@imagesStore')->name('subcategory.images.store');
    Route::post('subcategory/images/update', 'SubCategoryController@imagesUpdate')->name('subcategory.images.update');
    Route::get('subcategory/content/image-category/{id?}', 'SubCategoryController@findImageCategory');
    Route::delete('subcategory/content/image/{id}', 'SubCategoryController@imageDestroy')->name('subcategory.image.destroy');
    /** Fin Category*/

    /** Page Applications */
    Route::get('application/content', 'ApplicationController@content')->name('application.content');
    Route::get('application/create', 'ApplicationController@create')->name('application.content.create');
    Route::post('application/store', 'ApplicationController@store')->name('application.content.store');
    Route::get('application/edit/{id}', 'ApplicationController@edit')->name('application.content.edit');
    Route::post('application/update/{id}', 'ApplicationController@update')->name('application.content.update');
    Route::delete('application/content/{id}', 'ApplicationController@destroy')->name('application.content.destroy');
    Route::get('application/content/get-list', 'ApplicationController@getList')->name('application.slider.get-list');
    Route::get('application/content/get-images/{id}', 'ApplicationController@imagesCategory')->name('application.slider.get-images');
    Route::post('application/images/store', 'ApplicationController@imagesStore')->name('application.images.store');
    Route::post('application/images/update', 'ApplicationController@imagesUpdate')->name('application.images.update');
    Route::get('application/content/image-category/{id?}', 'ApplicationController@findImageCategory');
    Route::delete('application/content/image/{id}', 'ApplicationController@imageDestroy')->name('application.image.destroy');
    /** Fin Applications*/

    /** Page Industry*/
    Route::get('industry/content', 'IndustryController@content')->name('industry.content');
    Route::get('industry/create', 'IndustryController@create')->name('industry.content.create');
    Route::post('industry/store', 'IndustryController@store')->name('industry.content.store');
    Route::get('industry/edit/{id}', 'IndustryController@edit')->name('industry.content.edit');
    Route::post('industry/update/{id}', 'IndustryController@update')->name('industry.content.update');
    Route::delete('industry/content/{id}', 'IndustryController@destroy')->name('industry.content.destroy');
    Route::get('industry/content/get-list', 'IndustryController@getList')->name('industry.slider.get-list');
    Route::get('industry/content/get-images/{id}', 'IndustryController@imagesCategory')->name('industry.slider.get-images');
    Route::post('industry/images/store', 'IndustryController@imagesStore')->name('industry.images.store');
    Route::post('industry/images/update', 'IndustryController@imagesUpdate')->name('industry.images.update');
    Route::get('industry/content/image-category/{id?}', 'IndustryController@findImageCategory');
    Route::delete('industry/content/image/{id}', 'IndustryController@imageDestroy')->name('industry.image.destroy');
    /** Fin Industry*/

    /** Page Company */
    Route::get('quality/content', 'QualityController@content')->name('quality.content');
    Route::post('quality/content/store-slider', 'QualityController@storeSlider')->name('quality.content.storeSlider');
    Route::post('quality/content/update-slider', 'QualityController@updateSlider')->name('quality.content.updateSlider');
    Route::post('quality/qualities/store', 'QualityController@createInfo')->name('quality.info.store');
    Route::post('quality/content/update-info', 'QualityController@updateInfo')->name('quality.content.updateInfo');
    Route::post('quality/content/generic-section/update', 'QualityController@updateHomeGenericSection')->name('quality.content.generic-section.update');
    Route::delete('quality/content/{id}', 'QualityController@destroySlider')->name('quality.content.destroy');
    Route::get('quality/content/slider/get-list', 'QualityController@sliderGetList')->name('quality.slider.get-list');
    Route::get('quality/content/service/get-list', 'QualityController@serviceGetList')->name('quality.service.get-list');
    /** Fin company*/

    /** Page News */
    Route::get('news/content', 'NewsController@content')->name('news.content');
    Route::post('news/create', 'NewsController@createInfo')->name('news.content.createInfo');
    Route::post('news/content/update-info', 'NewsController@updateInfo')->name('news.content.updateInfo');
    Route::delete('news/content/{id}', 'NewsController@destroySlider')->name('news.content.destroy');
    Route::get('news/content/slider/get-list', 'NewsController@sliderGetList')->name('news.slider.get-list');
    /** Fin News*/

    /** Page company */
    Route::get('data/content', 'DataController@content')->name('data.content');
    Route::put('data/content', 'DataController@update')->name('data.content.update');
    /** Fin company*/

    /** Page company */
    Route::get('popup/content', 'PopupController@content')->name('popup.content');
    Route::put('popup/content', 'PopupController@update')->name('popup.content.update');
    /** Fin company*/

    Route::get('page/content', 'AdminPageController@content')->name('page.content');
    Route::put('page/content', 'AdminPageController@update')->name('page.content.update');

    Route::get('content/', 'ContentController@content')->name('content');
    Route::get('content/{id}', 'ContentController@findContent');
    Route::post('content/hero-update', 'ContentController@heroUpdate')->name('content.hero-update');
    Route::post('content/image/{id}/{reg}', 'ContentController@destroyImage')->name('content.destroy-image');

    Route::get('user/get-list', 'UserController@getList')->name('user.get-list');
    Route::resource('user', 'UserController');
});
