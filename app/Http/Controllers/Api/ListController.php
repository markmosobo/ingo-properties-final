<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Role;
use App\Models\Category;
use App\Models\PropertyType;
use App\Models\Condition;
use App\Models\Furnishing;
use App\Models\Location;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\About;
use App\Models\Service;
use App\Models\Contact;
use App\Models\SocialLink;
use App\Models\Message;
use App\Models\Project;
use App\Models\Landlord;
use App\Models\PmsProperty;
use App\Models\PmsUnit;
use App\Models\PmsTenant;
use App\Models\PmsExpense;
use App\Models\PmsStatement;
use App\Models\Invoice;
use App\Models\Testimonial;
use App\Models\Payment;
use App\Models\DefaultPassword;
use Carbon\Carbon;

class ListController extends Controller
{
    public function index()
    {
        $users = User::latest()->with('role')->get();
        $properties = Property::latest()->with('type','images')->get();
        $pmsproperties = PmsProperty::latest()->with('landlord','images','units')->get();
        $saleproperties = Property::latest()->with('type','images')->where('property_status','sale')->where('status',1)->get();
        $rentproperties = Property::latest()->with('type','images')->where('property_status','rent')->where('status',1)->get();
        $featuredproperties = Property::latest()->where('featured',1)->with('type','images')->where('status','=',1)->orWhere('status','=',2)->get();
        $roles = Role::all();
        $categories = Category::all();
        $propertytypes = PropertyType::all();
        $conditions = Condition::all();
        $furnishings = Furnishing::all();
        $locations = Location::all();
        $blogs = Blog::with('category')->get();
        $ourblogs = Blog::with('category')->where('status',1)->get();
        $featuredblogs = Blog::latest()->where('featured',1)->where('status',1)->get();
        $blogcategories = BlogCategory::all();
        $abouts = About::latest()->take(1)->get();
        $services = Service::all();
        $contacts = Contact::all();
        $sociallinks = SocialLink::all();
        $landlords = Landlord::all();
        $units = PmsUnit::all();
        $statements = PmsStatement::with('property', 'tenant')->latest()->get();        
        $pmstenants = PmsTenant::with('unit','property')->get();
        $pmsexpenses = PmsExpense::with('user')->get();

        $recentblogs= Blog::with('category')->orderBy('id', 'DESC')->limit(6)->get();
        $homefeaturedproperties = Property::latest()->where('featured',1)->with('type','images')->where('status',1)->limit(6)->get();
        $recentproperties = Property::inRandomOrder()->with('type','images')->where('featured',0)->where('status',1)->limit(6)->get();
        $messages = Message::latest()->where('status',0)->with('user')->get();
        $displaymessages = Message::latest()->with('user')->where('status',0)->limit(3)->get();
        $projects = Project::all();
        $homeprojects = Project::where('featured',0)->limit(4)->where('status', 1)->orWhere('status', 0)->get();
        $payments = Payment::latest()->get();
        $testimonials = Testimonial::latest()->get();
        $hometestimonials = Testimonial::where('status', 1)->limit(4)->get();
        $homeservices = Service::latest()->limit(6)->get();
        $featuredproject = Project::latest()->where('featured',1)->where('status', 1)->limit(1)->get();
        $openproperties = Property::latest()->with('type','images')->where('status',1)->get();
        $closedproperties = Property::latest()->with('type','images')->where('status',2)->get();

        //invoices
        $awaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereMonth('created_at', Carbon::now()->month)->get();
        $lastmonthawaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();
        $lastninetyawaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $quarterawaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();
        $yearawaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $lastyearawaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();
        $allawaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->get();
        $invoicestosettle = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->with('property','tenant','unit')->get();
        $invoicestosettlesmsnotsent = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->where('sms_status', 0)->with('property','tenant','unit')->get();
        $invoicestosettlesmssent = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->where('sms_status', 1)->with('property','tenant','unit')->get();
        $settledinvoices = PmsStatement::latest()->whereNotNull('water_bill')->where('status',1)->with('property','tenant','unit')->get();

        $defaultPassword = DefaultPassword::latest()->first();

        $userscount = User::all()->count();
        $tenantscount = PmsTenant::all()->count();
        $activetenantscount = PmsTenant::all()->where('status', 1)->count();
        $landlordscount = Landlord::all()->count();
        $projectscount = Project::all()->count();
        $blogscount = Blog::all()->count();
        $staffcount = User::all()->where('role_id', 2)->count();
        $regularuserscount = User::all()->where('role_id', 3)->count();
        $testimonialscount = Testimonial::all()->count();
        $approvedblogscount = Blog::with('category')->where('status',1)->count();

        $pmspropertiescount = PmsProperty::latest()->count();
        $pmsunitscount = PmsUnit::latest()->count();
        $vacatedunitscount = PmsUnit::where('status', 0)->count();
        $rentedunitscount = PmsUnit::where('status', 1)->count();
        $awaitinginvoicingcount = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->count();
        $invoicedcount = PmsStatement::latest()->whereNotNull('water_bill')->where('status',1)->count();

        return response()->json([
            "lists" => [
                'users' => $users,
                'properties' => $properties,
                'roles' => $roles,
                'categories' => $categories,
                'propertytypes' => $propertytypes,
                "conditions" => $conditions,
                'furnishings' => $furnishings,
                'locations' => $locations,
                'blogs' => $blogs,
                'ourblogs' => $ourblogs,
                'blogcategories' => $blogcategories,
                'abouts' => $abouts,
                'services' => $services,
                'homeservices' => $homeservices,
                'contacts' => $contacts,
                'sociallinks' => $sociallinks,
                'saleproperties' => $saleproperties,
                'rentproperties' => $rentproperties,
                'featuredproperties' => $featuredproperties,
                'featuredblogs' => $featuredblogs,
                'recentblogs' => $recentblogs,
                'homefeaturedproperties' => $homefeaturedproperties,
                'recentproperties' => $recentproperties,
                'messages' =>$messages,
                'displaymessages' => $displaymessages,
                'projects' => $projects,
                'homeprojects' => $homeprojects,
                'payments' => $payments,
                'testimonials' => $testimonials,
                'hometestimonials' => $hometestimonials,
                'featuredproject' => $featuredproject,
                'closedproperties' => $closedproperties,
                'openproperties' => $openproperties,
                'landlords' => $landlords,
                'pmsproperties' => $pmsproperties,
                'units' => $units,
                'pmstenants' => $pmstenants,
                'pmsexpenses' => $pmsexpenses,
                'statements' => $statements,
                // 'pmsinvoices' => $pmsinvoices,
                'awaitinginvoicing' => $awaitinginvoicing,
                'lastmonthawaitinginvoicing' => $lastmonthawaitinginvoicing,
                'lastninetyawaitinginvoicing' => $lastninetyawaitinginvoicing,
                'quarterawaitinginvoicing' => $quarterawaitinginvoicing,
                'yearawaitinginvoicing' => $yearawaitinginvoicing,
                'lastyearawaitinginvoicing' => $lastyearawaitinginvoicing,
                'allawaitinginvoicing' => $allawaitinginvoicing,
                'invoicestosettle' => $invoicestosettle,
                'invoicestosettlesmsnotsent' => $invoicestosettlesmsnotsent,
                'invoicestosettlesmssent' => $invoicestosettlesmssent,
                'settledinvoices' => $settledinvoices,

                'defaultPassword' => $defaultPassword,

                'userscount' => $userscount,
                'landlordscount' => $landlordscount,
                'tenantscount' => $tenantscount,
                'activetenantscount' => $activetenantscount,
                'projectscount' => $projectscount,
                'approvedblogscount' => $approvedblogscount,
                'blogscount' => $blogscount,
                'staffcount' => $staffcount,
                'regularuserscount' => $regularuserscount,
                'testimonialscount' => $testimonialscount,

                'pmspropertiescount' => $pmspropertiescount,
                'pmsunitscount' => $pmsunitscount,
                'rentedunitscount' => $rentedunitscount,
                'vacatedunitscount' => $vacatedunitscount,
                'awaitinginvoicingcount' => $awaitinginvoicingcount,
                'invoicedcount' => $invoicedcount,

                
            ]
        ]);

    }

    public function storeTestimonial(Request $request)
    {
        $testimonial = Testimonial::create([
            'full_name' => $request->full_name,
            'body' => $request->body,
            'label' => $request->label,
        ]);
        $testimonial->save();

         return response()->json([
            'status' => true,
            'message' => "Testimonial Created successfully!",
            'testimonial' => $testimonial
        ], 200);
    }

    public function updateTestimonial(Request $request, $id)
    {
       $testimonial = Testimonial::findOrFail($id);
        $testimonial->update([
            'full_name' => $request->full_name,
            'body' => $request->body,
            'label' => $request->label,
        ]);        
        return response()->json([
            'status' => true,
            'message' => "Testimonial Updated successfully!",
            'testimonial' => $testimonial
        ], 200);
    }

     public function destroyTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if($testimonial){
        $testimonial->delete();

        return response()->json([
            'status' => true,
            'message' => "Testimonial Deleted successfully!",
        ], 200);
        }
    }    

    public function approveTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if($testimonial){
            $testimonial->update(array('status' => 1));
            $testimonial->save();
        }
    }

    public function editTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if($testimonial){
            $testimonial->update($request->all());
        }

         return response()->json([
            'status' => true,
            'message' => "Testimonial Updated successfully!",
            'testimonial' => $testimonial
        ], 200);
    }

    public function updateDefaultPassword(Request $request)
    {
        $password = DefaultPassword::latest()->first();
        if ($password) {
        // Update the default_password field
        $password->update([
            'default_password' => $request->default_password
        ]);

        return response()->json([
            'status' => true,
            'message' => "Password Updated successfully!",
            'password' => $password
        ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No DefaultPassword record found!"
            ], 404);
        }

         return response()->json([
            'status' => true,
            'message' => "Password Updated successfully!",
            'password' => $password
        ], 200);
    }

    public function homePage()
    {
        $categories = Category::all();
        $propertytypes = PropertyType::all();
        $locations = Location::all();
        $homefeaturedproperties = Property::latest()
            ->where('featured', 1)
            ->where('status', 1)
            ->with('type', 'images')
            ->limit(6)
            ->get();
        $recentproperties = Property::inRandomOrder()
            ->where('featured', 0)
            ->where('status', 1)
            ->with('type', 'images')
            ->limit(6)
            ->get();
        $services = Service::all();
        $recentblogs = Blog::with('category')->latest()->limit(6)->get();
        $abouts = About::latest()->first();
        $homeprojects = Project::where('featured', 0)
            ->whereIn('status', [0, 1])
            ->limit(4)
            ->get();
        $hometestimonials = Testimonial::where('status', 1)->limit(4)->get();
        $featuredproject = Project::latest()
            ->where('featured', 1)
            ->where('status', 1)
            ->first();

        return response()->json([
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'locations' => $locations,
            'homefeaturedproperties' => $homefeaturedproperties,
            'recentproperties' => $recentproperties,
            'services' => $services,
            'recentblogs' => $recentblogs,
            'abouts' => $abouts,
            'homeprojects' => $homeprojects,
            'hometestimonials' => $hometestimonials,
            'featuredproject' => $featuredproject,
        ]);
    }

    public function saleProperties()
    {
        $categories = Category::all();
        $propertytypes = PropertyType::all();
        $saleproperties = Property::latest()->with('type','images')->where('property_status','sale')->where('status',1)->get();

        return response()->json([
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'saleproperties' => $saleproperties
        ]);        
    }

    public function socials()
    {
        $contacts = Contact::all();
        $sociallinks = SocialLink::all();

        return response()->json([
            'contacts' => $contacts,
            'sociallinks' => $sociallinks
        ]);
    }

    public function rentProperties()
    {
        $categories = Category::all();
        $propertytypes = PropertyType::all();
        $rentproperties = Property::latest()->with('type','images')->where('property_status','rent')->where('status',1)->get();

        return response()->json([
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'rentproperties' => $rentproperties
        ]);        
    }
    
    public function featuredProperties()
    {
        $categories = Category::all();
        $propertytypes = PropertyType::all();
        $featuredproperties = Property::latest()->where('featured',1)->with('type','images')->where('status','=',1)->orWhere('status','=',2)->get();

        return response()->json([
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'featuredproperties' => $featuredproperties
        ]);        
    } 
    
    public function projects()
    {
        $categories = Category::all();
        $projects = Project::all();
        $propertytypes = PropertyType::all();
        $properties = Property::latest()->with('type','images')->get();

        return response()->json([
            'categories' => $categories,
            'projects' => $projects,
            'properties' => $properties,
            'propertytypes' => $propertytypes            
        ]);        
    }  
    
    public function blogs()
    {
        $ourblogs = Blog::with('category')->where('status',1)->get();
        $blogcategories = BlogCategory::all();
        $users = User::latest()->with('role')->get();
        $blogs = Blog::with('category')->get();

        return response()->json([
            'ourblogs' => $ourblogs,
            'blogcategories' => $blogcategories,
            'users' => $users,
            'blogs' => $blogs
        ]);        
    } 

    public function featuredBlogs()
    {
        $blogcategories = BlogCategory::all();
        $blogs = Blog::with('category')->get();
        $users = User::latest()->with('role')->get();
        $featuredblogs = Blog::latest()->where('featured',1)->where('status',1)->get();

        return response()->json([
            'blogcategories' => $blogcategories,
            'blogs' => $blogs,
            'users' => $users,
            'featuredblogs' => $featuredblogs
        ]);        
    }     
    
    public function contacts()
    {
        $contacts = Contact::all();
        $sociallinks = SocialLink::all();

        return response()->json([
            'contacts' => $contacts,
            'sociallinks' => $sociallinks
        ]);        
    }
    
    public function landlords()
    {
        $landlords = Landlord::with('documents')->get();

        return response()->json([
            'landlords' => $landlords
        ]);        
    }
    
    public function tenants()
    {
        $tenants = PmsTenant::with('tenantDocuments','unit','property')->get();
        $properties = PmsProperty::latest()->with('landlord','images','units')->get();

        return response()->json([
            'tenants' => $tenants,
            'properties' => $properties
        ]);
    }
    
    public function listings()
    {
        $categories = Category::all();
        $properties = Property::latest()->with('type','images')->get();
        $propertytypes = PropertyType::all();

        return response()->json([
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'properties' => $properties
        ]);
    } 
    
    public function expenses()
    {

        $pmsexpenses = PmsExpense::with('user')->get();

        return response()->json([
            'pmsexpenses' => $pmsexpenses
        ]);
    } 
    
    public function users()
    {

        $users = User::latest()->with('role')->get();
        $defaultPassword = DefaultPassword::latest()->first();

        return response()->json([
            'users' => $users,
            'defaultPassword' => $defaultPassword,
        ]);
    }
    
    public function roles()
    {

        $roles = Role::all();

        return response()->json([
            'roles' => $roles
        ]);
    }
    
    public function abouts()
    {

        $abouts = About::latest()->take(1)->get();
        $services = Service::all();

        return response()->json([
            'abouts' => $abouts,
            'services' => $services
        ]);
    }  
    
    public function testimonials()
    {

        $testimonials = Testimonial::latest()->get();
        $defaultPassword = DefaultPassword::latest()->first();

        return response()->json([
            'testimonials' => $testimonials,
            'defaultPassword' => $defaultPassword,
        ]);
    } 
    
    public function payments()
    {

        $payments = Payment::latest()->get();

        return response()->json([
            'payments' => $payments,
        ]);
    }
    
    public function invoicesToSettle()
    {

        $invoicestosettle = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->with('property','tenant','unit')->get();
        $invoicestosettlesmsnotsent = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->where('sms_status', 0)->with('property','tenant','unit')->get();
        $invoicestosettlesmssent = PmsStatement::latest()->whereNotNull('water_bill')->where('status',0)->where('sms_status', 1)->with('property','tenant','unit')->get();
        $pmsexpenses = PmsExpense::with('user')->get();
        $awaitinginvoicing = PmsStatement::latest()->where('water_bill', null)->where('status',0)->with('property','tenant','unit')->whereMonth('created_at', Carbon::now()->month)->get();

        return response()->json([
            'invoicestosettle' => $invoicestosettle,
            'invoicestosettlesmsnotsent' => $invoicestosettlesmsnotsent,
            'invoicestosettlesmssent' => $invoicestosettlesmssent,
            'pmsexpenses' => $pmsexpenses,
            'awaitinginvoicing' => $awaitinginvoicing,
        ]);
    }    

}
