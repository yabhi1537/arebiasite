<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\AwqafController;
use App\Http\Controllers\ProjectfrontController;
use App\Http\Controllers\ChooseDonationamountController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\DedicationsController;
use App\Http\Controllers\RequestyourprojectController;
use App\Http\Controllers\SmallkiddonorprojectController;
use App\Http\Controllers\WhoweareController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MyFatoorahController;
use App\Http\Controllers\DeductionsController;
use App\Http\Controllers\NeedyfamiliesfrontController;
use App\Http\Controllers\ForgotPasswordController;



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
use App\Http\Controllers\Admin\smallkiddonorController;
use App\Http\Controllers\Admin\AchievementshowController;
use App\Http\Controllers\Admin\NewsreportshowController;
use App\Http\Controllers\Admin\DeductionshowController;
use App\Http\Controllers\Admin\AggregatesCodesController;
use App\Http\Controllers\Admin\DonationPolicyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GovernanceController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\ZakatShowController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\DashboardController;


  



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
	
	Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');

	 
	});

	
	Route::group(['prefix' => '/admin','middleware'=>'auth:admin'], function () {

		Route::post('/todo-status', [TodoController::class, 'changeStatusTodo'])->name('changeStatusTodo');
		
		   });

		   Route::middleware(['auth:admin'])->group(function() {Route::resource('/admin', TodoController::class)->names([

			'store'   => 'admin.store',
			// 'edit'     => 'admin.edit',
			// 'update'   => 'newsreportshow.update',
			'destroy'  => 'admin.destroy',
			
			]);
			});
	

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/zakatshow', ZakatShowController::class)->names([

		'index'    => 'zakatshow.index',
		'create'   => 'zakatshow.create',
		'store'    => 'zakatshow.store',
		'show'     => 'zakatshow.show',
		'edit'     => 'zakatshow.edit',
		'update'   => 'zakatshow.update',
		'destroy'  => 'zakatshow.destroy',
		
	]);
	});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/deductionshow', DeductionshowController::class)->names([

		'index'    => 'deductionshow.index',
		'show'     => 'deductionshow.show',
		'edit'     => 'deductionshow.edit',
		'update'   => 'deductionshow.update',
		
		]);
		});

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/newsreportshow', NewsreportshowController::class)->names([

		'index'    => 'newsreportshow.index',
		'show'     => 'newsreportshow.show',
		'edit'     => 'newsreportshow.edit',
		'update'   => 'newsreportshow.update',
		
		]);
		});


	Route::middleware(['auth:admin'])->group(function() {Route::resource('/achievementshow', AchievementshowController::class)->names([

		'index'    => 'achievementshow.index',
		'show'     => 'achievementshow.show',
		'edit'     => 'achievementshow.edit',
		'update'   => 'achievementshow.update',
		
		]);
		});


	Route::middleware(['auth:admin'])->group(function() {Route::resource('/smallkiddonor', smallkiddonorController::class)->names([

		'index'    => 'smallkiddonor.index',
		'show'     => 'smallkiddonor.show',
		'edit'     => 'smallkiddonor.edit',
		'update'   => 'smallkiddonor.update',
		
		]);
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

   Route::group(['prefix' => '/pendingtransaction','middleware'=>'auth:admin'], function () {
    Route::get('/file-export/{id}/{id2}', [TransactionController::class, 'pendingtransactionExport'])->name('pendingtransactionExport');
Route::get('/generate-pdf/{id}', [TransactionController::class, 'pendingtransactionPDF'])->name('pendingtransactionPDF');

	Route::get('/pendingtransaction', [TransactionController::class, 'pendingtransaction'])->name('pendingtransaction');
	Route::post('/pendingtransaction/{id}', [TransactionController::class, 'pendingdestroy'])->name('pendingdestroy');
	Route::get('/pendingtransaction/{id}', [TransactionController::class, 'pendingshow'])->name('pendingshow');

	
   });

   Route::group(['prefix' => '/failedtransaction','middleware'=>'auth:admin'], function () {
    Route::get('/file-export/{id}/{id2}', [TransactionController::class, 'failedtransactionExport'])->name('failedtransactionExport');
    Route::get('/generate-pdf/{id}', [TransactionController::class, 'failedtransactionPDF'])->name('failedtransactionPDF');
	Route::get('/failedtransaction', [TransactionController::class, 'failedtransaction'])->name('failedtransaction');
	Route::post('/failedtransaction/{id}', [TransactionController::class, 'destroye'])->name('destroye');
	Route::get('/failedtransaction/{id}', [TransactionController::class, 'shows'])->name('shows');

	
   });
    

   Route::group(['prefix' => '/completetransaction','middleware'=>'auth:admin'], function () {
	   
	Route::get('/file-export/{id}/{id2}', [TransactionController::class, 'completetransactionExport'])->name('completetransactionExport');
    Route::get('/generate-pdf/{id}', [TransactionController::class, 'completetransactionPDF'])->name('completetransactionPDF');   

	Route::get('/completetransaction', [TransactionController::class, 'completetransaction'])->name('completetransaction');
	Route::post('/completetransaction/{id}', [TransactionController::class, 'transactiondestroy'])->name('transactiondestroy');
	Route::get('/completetransaction/{id}', [TransactionController::class, 'transactionshow'])->name('transactionshow');
   });

	Route::middleware(['auth:admin'])->group(function() {Route::resource('/transaction', TransactionController::class)->names([

		'index'    => 'transaction.index',
		'show'     => 'transaction.show',
		'destroy'  => 'transaction.destroy',
	   
   ]);
   });
   
   Route::group(['prefix' => '/transaction','middleware'=>'auth:admin'], function () {

	   Route::get('/generate-pdf/{id}', [TransactionController::class, 'generatePDF'])->name('generatePDF');
	   Route::get('/file-export/{id}/{id2}', [TransactionController::class, 'fileExport'])->name('fileExport');
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
		Route::post('/projpubliStatus', [ProjectController::class, 'projpubliStatus'])->name('projpubliStatus');
		Route::post('/generatelink', [ProjectController::class, 'generatelinkstore'])->name('generatelinkstore');

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
		Route::post('/bannerreposition', [BannerController::class, 'bannerreposition'])->name('banner-reposition');
	
	   });
   
		   Route::middleware(['auth:admin'])->group(function() {Route::resource('/aggregatescodes', AggregatesCodesController::class)->names([

		'index'    => 'aggregatescodes.index',
		'create'   => 'aggregatescodes.create',
		'store'    => 'aggregatescodes.store',
		'show'     => 'aggregatescodes.show',
		'edit'     => 'aggregatescodes.edit',
		'update'   => 'aggregatescodes.update',
		'destroy'  => 'aggregatescodes.destroy',

		]);
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
	
	Route::middleware(['auth:admin'])->group(function() {Route::resource('/donationpolicy', DonationPolicyController::class)->names([

	'index'    => 'donationpolicy.index',
	'create'   => 'donationpolicy.create',
	'store'    => 'donationpolicy.store',
	'show'     => 'donationpolicy.show',
	'edit'     => 'donationpolicy.edit',
	'update'   => 'donationpolicy.update',
	'destroy'  => 'donationpolicy.destroy', 

	]);
	});
	 Route::middleware(['auth:admin'])->group(function() {Route::resource('/faq', FaqController::class)->names([

	'index'    => 'faq.index',
	'create'   => 'faq.create',
	'store'    => 'faq.store',
	'show'     => 'faq.show',
	'edit'     => 'faq.edit',
	'update'   => 'faq.update',
	'destroy'  => 'faq.destroy',

	]);
	});
	 Route::middleware(['auth:admin'])->group(function() {Route::resource('/governance', GovernanceController::class)->names([

	'index'    => 'governance.index',
	'show'     => 'governance.show',
	'edit'     => 'governance.edit',
	'update'   => 'governance.update',
	'destroy'  => 'governance.destroy',

	]);
	});
	
	   Route::group(['prefix' => '/mail','middleware'=>'auth:admin'], function () {

		Route::get('/send-email', [EmailController::class, 'index'])->name('emailview');;
		Route::post('/send-email', [EmailController::class, 'sendmail'])->name('sendmail');

		Route::post('/email-message', [EmailController::class, 'emailmessage'])->name('emailmessage');

		});

		Route::middleware(['auth:admin'])->group(function() {Route::resource('/mail', EmailController::class)->names([

		'index'    => 'mail.index',
		// 'show'     => 'deductionshow.show',
		// 'edit'     => 'deductionshow.edit',
		// 'update'   => 'deductionshow.update',

		]);
	  });

});

/*for fronend*/
Route::get('/{locale}',function($locale){
Session::put('locale',$locale);

        $segments = str_replace(url('/'), '', url()->previous());
        $segments = array_filter(explode('/', $segments));
        array_shift($segments);
        array_unshift($segments, $locale);

        return redirect()->to(implode('/', $segments));
        
})->name('switchLan');  //add name to router
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->group(function () {
		
	
	
		
    
	Route::get('/login', [FrontendAuthController::class, 'loginGet'])->name('login');
	Route::post('/login', [FrontendAuthController::class, 'loginPost']);
	Route::get('/login-cart', [FrontendAuthController::class, 'loginPost_cart'])->name('login-cart');
	Route::post('/login-cart', [FrontendAuthController::class, 'loginPost_cart']);
	
	
	Route::get('/logout', [FrontendAuthController::class, 'logout'])->name('logout');
	
	
	
	//Route::get('/register', [FrontendAuthController::class, 'registerGet'])->middleware('auth:web')->name('register');
	Route::get('/register', [FrontendAuthController::class, 'registerGet'])->name('register');
	Route::post('/register', [FrontendAuthController::class, 'registerPost']);
	Route::get('/register-cart', [FrontendAuthController::class, 'registerPost_cart'])->name('register-cart');
	Route::post('/register-cart', [FrontendAuthController::class, 'registerPost_cart']);
	
	
	Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
	Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
	Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
	Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
	
	Route::get('/awqaf', [AwqafController::class, 'index'])->name('awqaf');
	Route::get('/projects', [ProjectfrontController::class, 'index'])->name('projects');
	Route::get('/chooseDonation/{id}', [ChooseDonationamountController::class, 'index'])->name('chooseDonation');
	Route::get('/choosecharityDonation/{id}', [ChooseDonationamountController::class, 'choosecharityDonation'])->name('choosecharityDonation');
	Route::get('/sponsorship', [SponsorshipController::class, 'index'])->name('sponsorship');
	
	/*zakat calculator */
	Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat');
	Route::get('/zakat_project', [ZakatController::class, 'zakat_project'])->name('zakat_project');
	Route::get('/zakat_calculate', [ZakatController::class, 'zakat_calculate'])->name('zakat_calculate');
	Route::get('/zakat_value_delete', [ZakatController::class, 'zakat_value_delete'])->name('zakat_value_delete');
	
	Route::get('/dedications', [DedicationsController::class, 'index'])->name('dedications');
	Route::get('/giftDonation_preview', [DedicationsController::class, 'giftDonation_preview'])->name('giftDonation_preview');
	
	
	Route::get('/deductions', [DeductionsController::class, 'index'])->name('deductions');
	
	
	Route::get('/requestyourproject', [RequestyourprojectController::class, 'index'])->name('requestyourproject');
	Route::post('/saveproject_request', [RequestyourprojectController::class, 'saveproject_request'])->name('saveproject_request');
	
	Route::get('/needy_families', [NeedyfamiliesfrontController::class, 'index'])->name('needy_families');
	Route::post('/saveneedy_families', [NeedyfamiliesfrontController::class, 'saveneedy_families'])->name('saveneedy_families');
	

	Route::get('/smallkiddonorproject', [SmallkiddonorprojectController::class, 'index'])->name('smallkiddonorproject');
	
	/*who we are */
	Route::group(['prefix' => 'whoweare'], function () {
    Route::get('/aboutus', [WhoweareController::class, 'aboutus'])->name('aboutus');
    Route::get('/news', [WhoweareController::class, 'news'])->name('news');
    Route::get('/achievements', [WhoweareController::class, 'achievements'])->name('achievements');
    Route::get('/gallery', [WhoweareController::class, 'media_gallery'])->name('gallery');
    Route::get('/newsdetails/{id}', [WhoweareController::class, 'newsdetails'])->name('newsdetails');
    
    Route::get('/governance', [WhoweareController::class, 'governance'])->name('governance');
    Route::get('/faq', [WhoweareController::class, 'faq'])->name('faq');
    
    
    });
    
    Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');
    Route::post('/contactus', [HomeController::class, 'contactuspost'])->name('contactus');
    Route::get('/userprofile', [HomeController::class, 'userprofile'])->name('userprofile');
    Route::post('/updateuser-profile', [HomeController::class, 'updateuser_profile'])->name('updateuser-profile');
     Route::post('/updateuser-password', [HomeController::class, 'updateuser_password'])->name('updateuser-password');
    
    /*for cart */  
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/add-cart-project/{id}', [CartController::class, 'addProjecttoCart'])->name('addproduct.to.cart');
    Route::delete('/delete-cart-project', [CartController::class, 'deleteProject'])->name('delete.cart.project');
    Route::delete('/clear-cart-project', [CartController::class, 'clearcartProject'])->name('clear.cart.project');
    
    /*payment */
    Route::post('/knet/request', [MyFatoorahController::class, 'index'])->name('myfatoorah.request');
    Route::get('/knet/callback', [MyFatoorahController::class, 'callback'])->name('myfatoorah.callback');
    Route::get('/knet/knet_success/{id}', [MyFatoorahController::class, 'knet_success'])->name('myfatoorah.knet_success');
    Route::get('/knet/knet_error/{id}', [MyFatoorahController::class, 'knet_error'])->name('myfatoorah.knet_error');
    Route::get('/knet/knet_expired', [MyFatoorahController::class, 'knet_expired'])->name('myfatoorah.knet_expired');
    
    /*for recurring payment */
    //Route::post('/knet/emmbedded_session', [MyFatoorahController::class, 'emmbedded_session'])->name('myfatoorah.emmbedded_session');
     
    Route::post('/knet/recurring_request', [MyFatoorahController::class, 'recurring_request'])->name('myfatoorah.recurring_request');
    Route::get('/knet/callback_recurring', [MyFatoorahController::class, 'callback_recurring'])->name('myfatoorah.callback_recurring');
    Route::get('/knet/knet_recurring_success/{id}', [MyFatoorahController::class, 'knet_recurring_success'])->name('myfatoorah.knet_recurring_success');
    Route::get('/knet/knet_recurring_error/{id}', [MyFatoorahController::class, 'knet_recurring_error'])->name('myfatoorah.knet_recurring_error');
    
    
    Route::post('/knet/fastdonation_request', [MyFatoorahController::class, 'fastdonation_request'])->name('myfatoorah.fastdonation_request');
    
    
    /*payment cart */
    Route::post('/knet/cartpayment', [MyFatoorahController::class, 'cartpayment'])->name('myfatoorah.cartpayment');
    Route::get('/knet/callback-cart', [MyFatoorahController::class, 'callback_cart'])->name('myfatoorah.callback_cart');
    Route::get('/knet/knet_cart_success/{id}', [MyFatoorahController::class, 'knet_cart_success'])->name('myfatoorah.knet_cart_success');
    Route::get('/knet/knet_cart_error/{id}', [MyFatoorahController::class, 'knet_cart_error'])->name('myfatoorah.knet_cart_error');
    Route::get('/knet/knet_cart_expired', [MyFatoorahController::class, 'knet_cart_expired'])->name('myfatoorah.knet_cart_expired');
    
    
    /*payment for dedication */
    Route::post('/knet/dedication_request', [MyFatoorahController::class, 'dedication_request'])->name('myfatoorah.dedication_request');
    Route::get('/knet/dedication_callback', [MyFatoorahController::class, 'dedication_callback'])->name('myfatoorah.dedication_callback');
    Route::get('/knet/dedication_success/{id}', [MyFatoorahController::class, 'dedication_success'])->name('myfatoorah.dedication_success');
    Route::get('/knet/dedication_error/{id}', [MyFatoorahController::class, 'dedication_error'])->name('myfatoorah.dedication_error');
    Route::get('/knet/dedication_expired', [MyFatoorahController::class, 'dedication_expired'])->name('myfatoorah.dedication_expired');
    
    /*add wallet */
    Route::post('/knet/addwallet_request', [MyFatoorahController::class, 'addwallet_request'])->name('myfatoorah.addwallet_request');
    Route::get('/knet/callback-addwallet', [MyFatoorahController::class, 'callback_addwallet'])->name('myfatoorah.callback_addwallet');
    
  
  Route::get('/{id}/{code}/', [ChooseDonationamountController::class, 'setmarketer']);
		
});


