<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\AwqafController;
use App\Http\Controllers\ProjectfrontController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\DedicationsController;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NewsTypController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AchivementController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SociallController;
use App\Http\Controllers\Admin\ConteactController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\SponsortypController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactEnquiriesController;
use App\Http\Controllers\Admin\ContactAboutController;
use App\Http\Controllers\Admin\FounderController;
use App\Http\Controllers\Admin\MemberOfBoardController;
use App\Http\Controllers\Admin\MarketerController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\SponserTitllController;
use App\Http\Controllers\Admin\ContinentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NeedyFamiliesController;
use App\Http\Controllers\Admin\ProjectRequestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/* for admin */



Route::prefix('admin')->group(function (){
	
	Route::get('/',[AdminLoginController::class,'index'])->name('admin');	
	Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
	Route::post('/login',[AdminLoginController::class,'login'])->name('admin.login');;


	Route::middleware(['auth:admin'])->group(function () {
		
	Route::get('/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
	Route::get('/dashboard',function(){
		return view('admin.dashboard');
	});
	 
	});
	Route::middleware(['auth:admin'])->group(function() {Route::resource('/projectrequest', ProjectRequestController::class)->names([

		'index'    => 'projectrequest.index',
		'destroy'  => 'projectrequest.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/needyfamilies', NeedyFamiliesController::class)->names([

		'index'    => 'needyfamilies.index',
		'destroy'  => 'needyfamilies.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/gallery', GalleryController::class)->names([

		'index'    => 'gallery.index',
		'create'   => 'gallery.create',
		'store'    => 'gallery.store',
		'show'     => 'gallery.show',
		'edit'     => 'gallery.edit',
		'update'   => 'gallery.update',
		'destroy'  => 'gallery.destroy',
		
	]);
	});

	Route::group(['prefix' => '/country','middleware'=>'auth:admin'], function () {

		Route::post('/countrystatus', [CountryController::class, 'CountryStatus'])->name('CountryStatus');
		
		   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/country', CountryController::class)->names([

		'index'    => 'country.index',
		'create'   => 'country.create',
		'store'    => 'country.store',
		'show'     => 'country.show',
		'edit'     => 'country.edit',
		'update'   => 'country.update',
		'destroy'  => 'country.destroy',
		
	]);
	});


	Route::group(['prefix' => '/continet','middleware'=>'auth:admin'], function () {

	Route::post('/continentstatus', [ContinentController::class, 'ContinentStatus'])->name('ContinentStatus');
	
	   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/continet', ContinentController::class)->names([

		'index'    => 'continet.index',
		'create'   => 'continet.create',
		'store'    => 'continet.store',
		'show'     => 'continet.show',
		'edit'     => 'continet.edit',
		'update'   => 'continet.update',
		'destroy'  => 'continet.destroy',
		
	]);
	});


	Route::middleware(['auth:admin'])->group(function() {Route::resource('/sponsortitle', SponserTitllController::class)->names([

		'index'    => 'sponsortitle.index',
		'create'   => 'sponsortitle.create',
		'store'    => 'sponsortitle.store',
		'show'     => 'sponsortitle.show',
		'edit'     => 'sponsortitle.edit',
		'update'   => 'sponsortitle.update',
		'destroy'  => 'sponsortitle.destroy',
		
	]);
	});

	Route::group(['prefix' => '/task','middleware'=>'auth:admin'], function () {

		Route::post('/taskStatus', [TaskController::class, 'TaskStatus'])->name('TaskStatus');
	
	   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/task', TaskController::class)->names([

		'index'    => 'task.index',
		'create'   => 'task.create',
		'store'    => 'task.store',
		'show'     => 'task.show',
		'edit'     => 'task.edit',
		'update'   => 'task.update',
		'destroy'  => 'task.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/marketer', MarketerController::class)->names([

		'index'    => 'marketer.index',
		'create'   => 'marketer.create',
		'store'    => 'marketer.store',
		'show'     => 'marketer.show',
		'edit'     => 'marketer.edit',
		'update'   => 'marketer.update',
		'destroy'  => 'marketer.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/memberboard', MemberOfBoardController::class)->names([

		'index'    => 'memberboard.index',
		'create'   => 'memberboard.create',
		'store'    => 'memberboard.store',
		'show'     => 'memberboard.show',
		'edit'     => 'memberboard.edit',
		'update'   => 'memberboard.update',
		'destroy'  => 'memberboard.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/founder', FounderController::class)->names([

		'index'    => 'founder.index',
		'create'   => 'founder.create',
		'store'    => 'founder.store',
		'show'     => 'founder.show',
		'edit'     => 'founder.edit',
		'update'   => 'founder.update',
		'destroy'  => 'founder.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/contacabout', ContactAboutController::class)->names([

		'index'    => 'contacabout.index',
		'show'     => 'contacabout.show',
		'destroy'  => 'contacabout.destroy',

   ]);
   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/transaction', TransactionController::class)->names([

		'index'    => 'transaction.index',
		'show'     => 'transaction.show',
		'destroy'  => 'transaction.destroy',

	   
   ]);
   });

   Route::group(['prefix' => '/contactquery','middleware'=>'auth:admin'], function () {

    Route::post('/mail', [ContactEnquiriesController::class, 'mailsend'])->name('contacmail.send');

   });

   Route::middleware(['auth:admin'])->group(function() {Route::resource('/contactquery', ContactEnquiriesController::class)->names([

	'index'    => 'contactquery.index',
	'edit'     => 'contactquery.edit',
	'update'   => 'contactquery.update',	
	
   
   ]);
  });

   Route::middleware(['auth:admin'])->group(function() {Route::resource('/about', AboutController::class)->names([

	'index'    => 'about.index',
	'create'   => 'about.create',
	'store'    => 'about.store',
	'show'     => 'about.show',
	'edit'     => 'about.edit',
	'update'   => 'about.update',
	'destroy'  => 'about.destroy',
	
   
]);
});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/contactdetails', ConteactController::class)->names([

		'index'    => 'contect.index',
	    'create'   => 'contect.create',
		'store'    => 'contect.store',
	    'show'     => 'contect.show',
		'edit'     => 'contect.edit',
		'update'   => 'contect.update',
		'destroy'  => 'contect.destroy',
		
	   
   ]);
   });

   Route::group(['prefix' => '/sponsor','middleware'=>'auth:admin'], function () {

	Route::post('/sponserStatus', [SponsorController::class, 'sponserStatus'])->name('sponserStatus');

   });

   Route::middleware(['auth:admin'])->group(function() {Route::resource('/sponsor', SponsorController::class)->names([

	'index'    => 'sponsor.index',
	'create'   => 'sponsor.create',
	'store'    => 'sponsor.store',
	'show'     => 'sponsor.show',
	'edit'     => 'sponsor.edit',
	'update'   => 'sponsor.update',
	'destroy'  => 'sponsor.destroy',
	
   
]);
});

Route::group(['prefix' => '/sponsortype','middleware'=>'auth:admin'], function () {

	Route::post('/sponserTypStatus', [SponsortypController::class, 'sponserTypStatus'])->name('sponserTypStatus');

   });

Route::middleware(['auth:admin'])->group(function() {Route::resource('/sponsortype', SponsortypController::class)->names([

	'index'    => 'sponsortype.index',
	'create'   => 'sponsortype.create',
	'store'    => 'sponsortype.store',
	'show'     => 'sponsortype.show',
	'edit'     => 'sponsortype.edit',
	'update'   => 'sponsortype.update',
	'destroy'  => 'sponsortype.destroy',
	
   
]);
});

Route::group(['prefix' => '/sociall','middleware'=>'auth:admin'], function () {

	Route::post('/socialStatus', [SociallController::class, 'socialStatus'])->name('socialStatus');

   });
   
	Route::middleware(['auth:admin'])->group(function() {Route::resource('/sociall', SociallController::class)->names([

		'index'    => 'social.index',
	    'create'   => 'social.create',
		'store'    => 'social.store',
		'edit'     => 'social.edit',
		'update'   => 'social.update',
		'destroy'  => 'social.destroy',
		
	   
   ]);
   });



// 	Route::middleware(['auth:admin'])->group(function() {Route::resource('/adminprofile', ProfileController::class)->names([
// 		'index'     => 'profile.index',
// 		'update'    => 'profile.update',
// 	    'store'    => 'profile.store',
// 		// 'store'     => 'news.store',
// 		// 'show'      => 'news.show',
// 		// 'edit'      => 'news.edit',
// 		// 'destroy'   => 'news.destroy',
// 		// 'newsType'  => 'newsType.index',
//    ]);

    Route::group(['prefix' => '/adminprofile','middleware'=>'auth:admin'], function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/imgupdate', [ProfileController::class, 'imgupdate'])->name('profile.imgupdate');
	Route::post('/passupdate', [ProfileController::class, 'passupdate'])->name('profile.passupdate');
  
      });


	Route::middleware(['auth:admin'])->group(function() {Route::resource('/news', NewsController::class)->names([

		 'index'     => 'news.index',
		 'create'    => 'news.create',
		 'store'     => 'news.store',
		 'show'      => 'news.show',
		 'edit'      => 'news.edit',
		 'update'    => 'news.update',
		 'destroy'   => 'news.destroy',
		 'newsType'  => 'newsType.index',
		 
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/newstype', NewsTypController::class)->names([

		 'index'    => 'newsType.index',
		 'create'   => 'newstype.create',
		 'store'    => 'newstype.store',
		 'show'     => 'newstype.show',
		 'edit'     => 'newstype.edit',
		 'update'   => 'newstype.update',
		 'destroy'  => 'newstype.destroy',
		 
	]);
	});
	Route::middleware(['auth:admin'])->group(function() {Route::resource('/achivement', AchivementController::class)->names([

		'index'    => 'achivement.index',
		'create'   => 'achivement.create',
		'store'    => 'achivement.store',
		'show'     => 'achivement.show',
		'edit'     => 'achivement.edit',
		'update'   => 'achivement.update',
		'destroy'  => 'achivement.destroy',
		
	]);
	});

	Route::group(['prefix' => '/user','middleware'=>'auth:admin'], function () {

		Route::post('/userStatus', [UserController::class, 'userStatus'])->name('userStatus');
	
	   });


	Route::middleware(['auth:admin'])->group(function() {Route::resource('/user', UserController::class)->names([

		'index'    => 'user.index',
		'create'   => 'user.create',
		'store'    => 'user.store',
		'show'     => 'user.show',
		'edit'     => 'user.edit',
		'update'   => 'user.update',
		'destroy'  => 'user.destroy',
		
	]);
	});

	Route::group(['prefix' => '/category','middleware'=>'auth:admin'], function () {

		Route::post('/categoryStatus', [CategoryController::class, 'categoryStatus'])->name('categoryStatus');
	
	   });


	Route::middleware(['auth:admin'])->group(function() {Route::resource('/category', CategoryController::class)->names([

		'index'    => 'category.index',
	    'create'   => 'category.create',
		'store'    => 'category.store',
		'edit'     => 'category.edit',
		'update'   => 'category.update',
		'destroy'  => 'category.destroy',
		'show'     => 'category.show',
		
	   
   ]);
   });

   Route::group(['prefix' => '/projectype','middleware'=>'auth:admin'], function () {

	Route::post('/datajson', [ProjectTypeController::class, 'datajson'])->name('datajson');

   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/projectype', ProjectTypeController::class)->names([

		 'index'    => 'projectype.index',
		 'create'   => 'projectype.create',
		 'store'    => 'projectype.store',
		 'show'     => 'projectype.show',
		 'edit'     => 'projectype.edit',
		 'update'   => 'projectype.update',
		 'destroy'  => 'projectype.destroy',
		
	]);
	});

	Route::group(['prefix' => '/projects','middleware'=>'auth:admin'], function () {

		Route::post('/donationtypeStatus', [ProjectController::class, 'donationtypeStatus'])->name('donationtypeStatus');
	
	   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/projects', ProjectController::class)->names([

		'index'    => 'project.index',
		'create'   => 'project.create',
		'store'    => 'project.store',
		'edit'     => 'project.edit',
		'show'     => 'project.show',
		'update'   => 'project.update',
		'destroy'  => 'project.destroy',
		 
	]);
	});

	Route::group(['prefix' => '/banner','middleware'=>'auth:admin'], function () {

		Route::post('/bannerStatus', [BannerController::class, 'bannerStatus'])->name('bannerStatus');
	
	   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/banner', BannerController::class)->names([

		'index'     => 'banner.index',
		'create'    => 'banner.create',
		'store'     => 'banner.store',
		'edit'      => 'banner.edit',
		'show'      => 'banner.show',
		'update'    => 'banner.update',
		'destroy'   => 'banner.destroy',
		 
	]);
	});

});


Route::get('/{locale}',function($locale){
Session::put('locale',$locale);
           return redirect('/');
          })->name('switchLan');  //add name to router
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->group(function () {
    
	Route::get('/login', [FrontendAuthController::class, 'loginGet'])->name('login');
	Route::post('/login', [FrontendAuthController::class, 'loginPost']);
	Route::get('/logout', [FrontendAuthController::class, 'logout'])->name('logout');
	//Route::get('/register', [FrontendAuthController::class, 'registerGet'])->middleware('auth:web')->name('register');
	Route::get('/register', [FrontendAuthController::class, 'registerGet'])->name('register');
	Route::post('/register', [FrontendAuthController::class, 'registerPost']);
	
	Route::get('/awqaf', [AwqafController::class, 'index'])->name('awqaf');
	Route::get('/projects', [ProjectfrontController::class, 'index'])->name('projects');
	Route::get('/sponsorship', [SponsorshipController::class, 'index'])->name('sponsorship');
	Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat');
	Route::get('/dedications', [DedicationsController::class, 'index'])->name('dedications');
	
	
});