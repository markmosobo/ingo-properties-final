import {  createRouter, createWebHistory  } from 'vue-router';
import Index from '../views/Index.vue'
import About from '../views/About.vue'
import Contact from '../views/Contact.vue'
// import Properties from '../views/Properties.vue'
// import Property from '../views/Property.vue'
import Blogs from '../views/Blogs.vue'
import Blog from '../views/Blog.vue'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import AllProjects from '../views/projects/AllProjects.vue'
import AddProject from '../views/projects/AddProject.vue'
import ViewProject from '../views/projects/ViewProject.vue'
import EditProject from '../views/projects/EditProject.vue'
import AllProperties from '../views/properties/AllProperties.vue'
import FeaturedProperties from '../views/properties/FeaturedProperties.vue'
import MyProperties from '../views/properties/MyProperties.vue'
import AddProperty from '../views/properties/AddProperty.vue'
import ViewProperty from '../views/properties/ViewProperty.vue'
import EditProperty from '../views/properties/EditProperty.vue'
import AllCategories from '../views/categories/AllCategories.vue'
import AddCategory from '../views/categories/AddCategory.vue'
import ViewCategory from '../views/categories/ViewCategory.vue'
import EditCategory from '../views/categories/EditCategory.vue'
import AllPropertyTypes from '../views/propertytypes/AllPropertyTypes.vue'
import AddPropertyType from '../views/propertytypes/AddPropertyType.vue'
import ViewPropertyType from '../views/propertytypes/ViewPropertyType.vue'
import EditPropertyType from '../views/propertytypes/EditPropertyType.vue'
import AllConditions from '../views/conditions/AllConditions.vue'
import AddCondition from '../views/conditions/AddCondition.vue'
import ViewCondition from '../views/conditions/ViewCondition.vue'
import EditCondition from '../views/conditions/EditCondition.vue'
import AllFurnishings from '../views/furnishings/AllFurnishings.vue'
import AddFurnishing from '../views/furnishings/AddFurnishing.vue'
import ViewFurnishing from '../views/furnishings/ViewFurnishing.vue'
import EditFurnishing from '../views/furnishings/EditFurnishing.vue'
import AllLocations from '../views/locations/AllLocations.vue'
import AddLocation from '../views/locations/AddLocation.vue'
import ViewLocation from '../views/locations/ViewLocation.vue'
import EditLocation from '../views/locations/EditLocation.vue'
import AllBlogCategories from '../views/blogcategories/AllBlogCategories.vue'
import AddBlogCategory from '../views/blogcategories/AddBlogCategory.vue'
import AllBlogs from '../views/blogs/AllBlogs.vue'
import FeaturedBlogs from '../views/blogs/FeaturedBlogs.vue'
import AddBlog from '../views/blogs/AddBlog.vue'
import EditBlog from '../views/blogs/EditBlog.vue'
import ViewBlog from '../views/blogs/ViewBlog.vue'
import AllAbouts from '../views/about/AllAbouts.vue'
import AddAbout from '../views/about/AddAbout.vue'
import EditAbout from '../views/about/EditAbout.vue'
import EditService from '../views/services/EditService.vue'
import AllContacts from '../views/contacts/AllContacts.vue'
import EditContact from '../views/contacts/EditContact.vue'
import AddSocialLink from '../views/sociallinks/AddSocialLink.vue'
import EditSocialLink from '../views/sociallinks/EditSocialLink.vue'
import Profile from '../views/Profile.vue'
import AllUsers from '../views/users/AllUsers.vue'
import ViewUser from '../views/users/ViewUser.vue'
import OurServices from '../views/OurServices.vue'
import Service from '../views/Service.vue'
import SearchResultPage from '../views/SearchResultPage.vue'
import Projects from '../views/Projects.vue'
import Project from '../views/Project.vue'
const routes = [
    {
        path:'/',
        name: 'index',
        component: Index
    },
    {
        path:'/aboutus',
        name: 'about',
        component: About
    },
    {
        path:'/contactus',
        name: 'contact',
        component: Contact
    },
    {
        path:'/ourservices',
        name: 'ourservices',
        component: OurServices
    },
    {
        path:'/ourservices/:id',
        name: 'view-service',
        component: Service
    },
    {
        path:'/allproperties',
        name: 'properties',
        component : () => import("../views/Properties.vue")
        // component: Properties
    },
    {
        path:'/rentproperties',
        name: 'rentproperties',
        component : () => import("../views/RentProperties.vue")
        // component: Properties
    },
    {
        path:'/saleproperties',
        name: 'saleproperties',
        component : () => import("../views/SaleProperties.vue")
        // component: Properties
    },
    {
        path:'/categoryproperties/:id',
        name: 'categoryproperties',
        component : () => import("../views/CategoryProperties.vue")
        // component: Properties
    },
    {
        path: '/properties/:id',
        name: 'view-property',
        component : () => import("../views/PropertyTest.vue")
        // component: Property,

    },
    {
        path:'/ourblogs',
        name: 'ourblogs',
        component: Blogs
    },
    {
        path: '/ourblogs/:id',
        name: 'view-blog',
        component: Blog,

    },
    {
        path:'/ourprojects',
        name: 'ourprojects',
        component: Projects
    },
    {
        path: '/ourprojects/:id',
        name: 'view-project',
        component: Project,

    },
    {
        path:'/login',
        name: 'login',
        component: Login
    },
    {
        path:'/register',
        name: 'register',
        component: Register
    },
    //auth routes
    {
        path:'/dashboard',
        name: 'dashboard',
        component: Home
    },
    {
        path:'/all-projects',
        name: 'all-projects',
        component: AllProjects
    },
    {
        path:'/all-properties',
        name: 'all-properties',
        component: AllProperties
    },
    {
        path:'/featured-properties',
        name: 'featured-properties',
        component: FeaturedProperties
    },
    {
        path:'/my-properties',
        name: 'my-properties',
        component: MyProperties
    },
    {
        path:'/all-categories',
        name: 'all-categories',
        component: AllCategories
    },
    {
        path:'/all-propertytypes',
        name: 'all-propertytypes',
        component: AllPropertyTypes
    },
    {
        path:'/all-conditions',
        name: 'all-conditions',
        component: AllConditions
    },
    {
        path:'/all-furnishings',
        name: 'all-furnishings',
        component: AllFurnishings
    },
    {
        path:'/all-locations',
        name: 'all-locations',
        component: AllLocations
    },
    {
        path:'/all-blogcategories',
        name: 'all-blogcategories',
        component: AllBlogCategories
    },
    {
        path:'/all-blogs',
        name: 'all-blogs',
        component: AllBlogs
    },
    {
        path:'/featured-blogs',
        name: 'featured-blogs',
        component: FeaturedBlogs
    },
    {
        path:'/all-abouts',
        name: 'all-abouts',
        component: AllAbouts
    },
    {
        path:'/all-contacts',
        name: 'all-contacts',
        component: AllContacts
    },
    {
        path:'/all-users',
        name: 'all-users',
        component: AllUsers
    },
    //forms
    {
        path:'/add-category',
        name: 'add-category',
        component: AddCategory
    },
    {
        path:'/add-project',
        name: 'add-project',
        component: AddProject
    },
    {
        path:'/add-property',
        name: 'add-property',
        component: AddProperty
    },
    {
        path:'/add-propertytype',
        name: 'add-propertytype',
        component: AddPropertyType
    },
    {
        path:'/add-condition',
        name: 'add-condition',
        component: AddCondition
    },
    {
        path:'/add-furnishing',
        name: 'add-furnishing',
        component: AddFurnishing
    },
    {
        path:'/add-location',
        name: 'add-location',
        component: AddLocation
    },
    {
        path:'/add-sociallink',
        name: 'add-sociallink',
        component: AddSocialLink
    },
    {
        path:'/editproject/:id',
        name: 'editproject',
        component: EditProject
    },
    {
        path:'/editproperty/:id',
        name: 'editproperty',
        component: EditProperty
    },
    {
        path:'/edit-category/:id',
        name: 'edit-category',
        component: EditCategory
    },
    {
        path:'/edit-propertytype/:id',
        name: 'edit-propertytype',
        component: EditPropertyType
    },
    {
        path:'/edit-condition/:id',
        name: 'edit-condition',
        component: EditCondition
    },
    {
        path:'/edit-furnishing/:id',
        name: 'edit-furnishing',
        component: EditFurnishing
    },
    {
        path:'/edit-location/:id',
        name: 'edit-location',
        component: EditLocation
    },
    {
        path:'/edit-about/:id',
        name: 'edit-about',
        component: EditAbout
    },
    {
        path:'/edit-contact/:id',
        name: 'edit-contact',
        component: EditContact
    },
    {
        path:'/edit-service/:id',
        name: 'edit-service',
        component: EditService
    },
    {
        path:'/edit-blog/:id',
        name: 'edit-blog',
        component: EditBlog
    },
    {
        path:'/edit-sociallink/:id',
        name: 'edit-sociallink',
        component: EditSocialLink
    },
    {
        path: '/viewproject/:id',
        name: 'viewproject',
        component: ViewProject,

    },
    {
        path: '/viewproperty/:id',
        name: 'viewproperty',
        component: ViewProperty,

    },
    {
        path: '/viewcategory/:id',
        name: 'viewcategory',
        component: ViewCategory,

    },
    {
        path: '/viewpropertytype/:id',
        name: 'viewpropertytype',
        component: ViewPropertyType,

    },
    {
        path: '/viewcondition/:id',
        name: 'viewcondition',
        component: ViewCondition,

    },
    {
        path: '/viewfurnishing/:id',
        name: 'viewfurnishing',
        component: ViewFurnishing,

    },
    {
        path: '/viewlocation/:id',
        name: 'viewlocation',
        component: ViewLocation,

    },
    {
        path: '/viewblog/:id',
        name: 'viewblog',
        component: ViewBlog,

    },
    {
        path: '/viewuser/:id',
        name: 'viewuser',
        component: ViewUser,

    },
    {
        path:'/add-blogcategory',
        name: 'add-blogcategory',
        component: AddBlogCategory
    },
    {
        path:'/add-blog',
        name: 'add-blog',
        component: AddBlog
    },
    {
        path:'/add-about',
        name: 'add-about',
        component: AddAbout
    },
    {
        path:'/add-sociallink',
        name: 'add-sociallink',
        component: AddSocialLink
    },
    {
        path:'/profile',
        name: 'profile',
        component: Profile,
        // meta: { requiresAuth: true }
         // Add this meta field to indicate that authentication is required

    },
    {
        path:'/search-results',
        name: 'SearchResultPage',
        component: SearchResultPage,
        props: true
    },
];

const router = createRouter({
    history: createWebHistory('/'),
    routes
});


router.beforeEach((to, from, next) => {
    const isAuthenticated = '';
    
    if (to.matched.some(route => route.meta.requiresAuth)) {
      // If the route requires authentication and the user is not authenticated, redirect to the login page
      if (!isAuthenticated) {
        next('/login');
      } else {
        next();
      }
    } else {
      // If the route doesn't require authentication, proceed as usual
      next();
    }
  });


export default router;