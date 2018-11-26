// Dynamic Loading Modules
// Views
const Dashboard = resolve => { require.ensure(['../views/Dashboard.vue'], ()=>{ resolve(require('../views/Dashboard.vue')); }); };

const IncidenceType = resolve => { 
    require.ensure(['../views/IncidenceType.vue'], ()=>{ resolve(require('../views/IncidenceType.vue')); }); 
};

const IncidenceTypeDetail = resolve => { 
    require.ensure(['../views/incidencetype/IncidenceTypeDetail.vue'], ()=>{ resolve(require('../views/incidencetype/IncidenceTypeDetail.vue')); }); 
};

const IncidenceTypeEdit = resolve => { 
    require.ensure(['../views/incidencetype/IncidenceTypeEdit.vue'], ()=>{ resolve(require('../views/incidencetype/IncidenceTypeEdit.vue')); }); 
};

const CompanyType = resolve => { 
    require.ensure(['../views/CompanyType.vue'], ()=>{ resolve(require('../views/CompanyType.vue')); }); 
};

const CompanyTypeDetail = resolve => { 
    require.ensure(['../views/company-type/CompanyTypeDetail.vue'], ()=>{ resolve(require('../views/company-type/CompanyTypeDetail.vue')); }); 
};

const CompanyTypeEdit = resolve => { 
    require.ensure(['../views/company-type/CompanyTypeEdit.vue'], ()=>{ resolve(require('../views/company-type/CompanyTypeEdit.vue')); }); 
};

const DocumentType = resolve => { 
    require.ensure(['../views/DocumentType.vue'], ()=>{ resolve(require('../views/DocumentType.vue')); }); 
};

const DocumentTypeDetail = resolve => { 
    require.ensure(['../views/document-type/DocumentTypeDetail.vue'], ()=>{ resolve(require('../views/document-type/DocumentTypeDetail.vue')); }); 
};

const DocumentTypeEdit = resolve => { 
    require.ensure(['../views/document-type/DocumentTypeEdit.vue'], ()=>{ resolve(require('../views/document-type/DocumentTypeEdit.vue')); }); 
};



const RequerimentType = resolve => { 
    require.ensure(['../views/RequerimentType.vue'], ()=>{ resolve(require('../views/RequerimentType.vue')); }); 
};

const RequerimentTypeDetail = resolve => { 
    require.ensure(['../views/requeriment-type/RequerimentTypeDetail.vue'], ()=>{ resolve(require('../views/requeriment-type/RequerimentTypeDetail.vue')); }); 
};

const RequerimentTypeEdit = resolve => { 
    require.ensure(['../views/requeriment-type/RequerimentTypeEdit.vue'], ()=>{ resolve(require('../views/requeriment-type/RequerimentTypeEdit.vue')); }); 
};

const Login = resolve => { 
    require.ensure(['../Login.vue'], ()=>{ resolve(require('../Login.vue')); }); 
}


const Question = resolve => { 
    require.ensure(['../views/Question.vue'], ()=>{ resolve(require('../views/Question.vue')); }); 
};

const QuestionEdit = resolve => { 
    require.ensure(['../views/question/QuestionEdit.vue'], ()=>{ resolve(require('../views/question/QuestionEdit.vue')); }); 
};

const Requeriment = resolve => { 
    require.ensure(['../views/Requeriment.vue'], ()=>{ resolve(require('../views/Requeriment.vue')); }); 
};

const RequerimentDetail = resolve => { 
    require.ensure(['../views/requeriment/RequerimentDetail.vue'], ()=>{ resolve(require('../views/requeriment/RequerimentDetail.vue')); }); 
};

const RequerimentEdit = resolve => { 
    require.ensure(['../views/requeriment/RequerimentEdit.vue'], ()=>{ resolve(require('../views/requeriment/RequerimentEdit.vue')); }); 
};

const Company = resolve => { 
    require.ensure(['../views/Company.vue'], ()=>{ resolve(require('../views/Company.vue')); }); 
};


const CompanyEnProceso = resolve => { 
    require.ensure(['../views/CompanyEnProceso.vue'], ()=>{ resolve(require('../views/CompanyEnProceso.vue')); }); 
};

const CompanyRechazada = resolve => { 
    require.ensure(['../views/CompanyEnProceso.vue'], ()=>{ resolve(require('../views/CompanyRechazada.vue')); }); 
};

const CompanyAprobada = resolve => { 
    require.ensure(['../views/CompanyAprobada.vue'], ()=>{ resolve(require('../views/CompanyAprobada.vue')); }); 
};


const CompanyDetail = resolve => { 
    require.ensure(['../views/company/CompanyDetail.vue'], ()=>{ resolve(require('../views/company/CompanyDetail.vue')); }); 
};


const CompanyDocument = resolve => { 
    require.ensure(['../views/company/CompanyDocument.vue'], ()=>{ resolve(require('../views/company/CompanyDocument.vue')); }); 
};


const Roles = resolve => { 
    require.ensure(['../views/Roles.vue'], ()=>{ resolve(require('../views/Roles.vue')); }); 
};
const NewRol = resolve => {
    require.ensure(['../views/NewRol.vue'], ()=>{ resolve(require('../views/NewRol.vue')); }); 
};


const Users = resolve => {
    require.ensure(['../views/Users.vue'], ()=>{ resolve(require('../views/Users.vue')); }); 
};
const NewUser = resolve => {
    require.ensure(['../views/NewUser.vue'], ()=>{ resolve(require('../views/NewUser.vue')); }); 
};

const Dates = resolve => {
    require.ensure(['../views/Dates.vue'], ()=>{ resolve(require('../views/Dates.vue')); });
}
const Charts = resolve => {
    require.ensure(['../views/Charts.vue'], ()=>{ resolve(require('../views/Charts.vue')); });
}
/*

// UI Components
const Buttons = resolve => { require.ensure(['../components/Buttons.vue'], ()=>{ resolve(require('../components/Buttons.vue')); }); };
const Socials = resolve => { require.ensure(['../components/Socials.vue'], ()=>{ resolve(require('../components/Socials.vue')); }); };
const Badges = resolve => { require.ensure(['../components/Badges.vue'], ()=>{ resolve(require('../components/Badges.vue')); }); };
const Cards = resolve => { require.ensure(['../components/Cards.vue'], ()=>{ resolve(require('../components/Cards.vue')); }); };
const Modals = resolve => { require.ensure(['../components/Modals.vue'], ()=>{ resolve(require('../components/Modals.vue')); }); };
const Alerts = resolve => { require.ensure(['../components/Alerts.vue'], ()=>{ resolve(require('../components/Alerts.vue')); }); };
const ProgressBars = resolve => { require.ensure(['../components/ProgressBars.vue'], ()=>{ resolve(require('../components/ProgressBars.vue')); }); };

const BasicForms = resolve => { require.ensure(['../components/forms/BasicForms.vue'], ()=>{ resolve(require('../components/forms/BasicForms.vue')); }); };
const Grids = resolve => { require.ensure(['../components/Grids.vue'], ()=>{ resolve(require('../components/Grids.vue')); }); };
const Widgets = resolve => { require.ensure(['../components/Widgets.vue'], ()=>{ resolve(require('../components/Widgets.vue')); }); };
const Typography = resolve => { require.ensure(['../components/Typography.vue'], ()=>{ resolve(require('../components/Typography.vue')); }); };
const Icons = resolve => { require.ensure(['../components/icons/Icons.vue'], ()=>{ resolve(require('../components/icons/Icons.vue')); }); };
const SetsList = resolve => { require.ensure(['../components/icons/SetsList.vue'], ()=>{ resolve(require('../components/icons/SetsList.vue')); }); };
const Sets = resolve => { require.ensure(['../components/icons/Set.vue'], ()=>{ resolve(require('../components/icons/Set.vue')); }); };
const Tables = resolve => { require.ensure(['../components/tables/Tables.vue'], ()=>{ resolve(require('../components/tables/Tables.vue')); }); };


//Charts
const ChartJS = resolve => { require.ensure(['../components/charts/ChartJS.vue'], ()=>{ resolve(require('../components/charts/ChartJS.vue')); }); };
const FlotChart = resolve => { require.ensure(['../components/charts/FlotChart.vue'], ()=>{ resolve(require('../components/charts/FlotChart.vue')); }); };


//Maps
const GoogleMapsPage = resolve => { require.ensure(['../components/maps/google-maps/GoogleMapsPage.vue'], ()=>{ resolve(require('../components/maps/google-maps/GoogleMapsPage.vue')); }); };
const LeafletMapsPage = resolve => { require.ensure(['../components/maps/leaflet-maps/LeafletMapsPage.vue'], ()=>{ resolve(require('../components/maps/leaflet-maps/LeafletMapsPage.vue')); }); };


// // User Info
// const User = resolve => { require.ensure(['../layouts/User.vue'], ()=>{ resolve(require('../layouts/User.vue')); }); };

//Pages
const Login = resolve => { require.ensure(['../pages/login/Login.vue'], ()=>{ resolve(require('../pages/login/Login.vue')); }); };
const Register = resolve => { require.ensure(['../pages/register/Register.vue'], ()=>{ resolve(require('../pages/register/Register.vue')); }); };
const Page404 = resolve => { require.ensure(['../pages/Page404.vue'], ()=>{ resolve(require('../pages/Page404.vue')); }); };
const Page500 = resolve => { require.ensure(['../pages/Page500.vue'], ()=>{ resolve(require('../pages/Page500.vue')); }); };

*/
export const routes = [
    {
        path : '',
        name: 'home',
        components:{
            default: Dashboard
        },
        meta: { requiresAuth: true} 
    },
    /*************************************************************/
    {   
        path : '/incidence-type', name: 'incidenceType', component: IncidenceType, meta: { requiresAuth: true} 
    },
    {   
        path: '/incidence-type-new', name: 'incidence-type-new', component: IncidenceTypeEdit , meta: { requiresAuth: true} 
    },
    {   
        path: '/incidence-type/:id', name: 'incidence-type-edit', component: IncidenceTypeEdit , meta: { requiresAuth: true} 
    },
    {   
        path: '/incidence-type/show/:id', name: 'incidence-type-detail', component: IncidenceTypeDetail , meta: { requiresAuth: true} 
    },

    /*************************************************************/
    {   
        path : '/company-type', name: 'company-type', component: CompanyType, meta: { requiresAuth: true} 
    },
    {   
        path: '/company-type-new', name: 'company-type-new', component: CompanyTypeEdit , meta: { requiresAuth: true} 
    },
    {   
        path: '/company-type/:id', name: 'company-type-edit', component: CompanyTypeEdit , meta: { requiresAuth: true} 
    },
    {   
        path: '/company-type/show/:id', name: 'company-type-detail', component: CompanyTypeDetail , meta: { requiresAuth: true} 
    },

    /*************************************************************/
    {   
        path : '/document-type', name: 'document-type', component: DocumentType, meta: { requiresAuth: true} 
    },
    {   
        path: '/document-type-new', name: 'document-type-new', component: DocumentTypeEdit, meta: { requiresAuth: true}  
    },
    {   
        path: '/document-type/:id', name: 'document-type-edit', component: DocumentTypeEdit, meta: { requiresAuth: true}  
    },
    {   
        path: '/document-type/show/:id', name: 'document-type-detail', component: DocumentTypeDetail, meta: { requiresAuth: true}  
    },

    /*************************************************************/
    {   
        path : '/requeriment-type', name: 'requeriment-type', component: RequerimentType, meta: { requiresAuth: true} 
    },
    {   
        path: '/requeriment-type-new', name: 'requeriment-type-new', component: RequerimentTypeEdit , meta: { requiresAuth: true} 
    },
    {   
        path: '/requeriment-type/:id', name: 'requeriment-type-edit', component: RequerimentTypeEdit, meta: { requiresAuth: true}  
    },
    {   
        path: '/requeriment-type/show/:id', name: 'requeriment-type-detail', component: RequerimentTypeDetail, meta: { requiresAuth: true}  
    },

    /*************************************************************/
    {   
        path : '/requeriment', name: 'requeriment', component: Requeriment, meta: { requiresAuth: true} 
    },
    {   
        path: '/requeriment-new', name: 'requeriment-new', component: RequerimentEdit , meta: { requiresAuth: true} 
    },
    {   
        path: '/requeriment/:id', name: 'requeriment-edit', component: RequerimentEdit, meta: { requiresAuth: true}  
    },
    {   
        path: '/requeriment/show/:id', name: 'requeriment-detail', component: RequerimentDetail, meta: { requiresAuth: true}  
    },

    /**********************************************************************/
    {   
        path : '/question', name: 'question', component: Question, meta: { requiresAuth: true} 
    },
    {   
        path: '/question/:id', name: 'question-edit', component: QuestionEdit, meta: { requiresAuth: true}  
    },
    /********************************************************************************************************/
    {   
        path : '/companies/news', name: 'companies-news', component: Company, meta: { requiresAuth: true}
    },
    {   
        path: '/companies/news/show/:id', name: 'companies-news-detail', component: CompanyDetail , meta: { requiresAuth: true} 
    },
    {   
        path: '/companies/news/show/:id/documents', name: 'companies-documents', component: CompanyDocument , meta: { requiresAuth: true} 
    },

    {   
        path : '/companies/enproceso', name: 'companies-en-proceso', component: CompanyEnProceso, meta: { requiresAuth: true} 
    },

    {   
        path : '/companies/rechazada', name: 'companies-rehazada', component: CompanyRechazada, meta: { requiresAuth: true} 
    },

    {   
        path : '/companies/aprobadas', name: 'companies-aprobadas', component: CompanyAprobada, meta: { requiresAuth: true} 
    },

    /********************************************************************************************************/
    {
        path : '/roles', name: 'roles', component: Roles, meta : {requiresAuth: true}
    },
    {
        path : '/newrol', name: 'new-rol', component: NewRol, meta : {requiresAuth: true}
    },
    {   
        path: '/roles/:id', name: 'role-edit', component: NewRol , meta: { requiresAuth: true} 
    },
    /********************************************************************************************************/
    {   
        path: '/users', name: 'users', component: Users , meta: { requiresAuth: true} 
    },
    {   
        path: '/newuser', name: 'new-user', component: NewUser, meta: {requiresAuth: true}
    },
    {   
        path: '/users/:id', name: 'edit-user', component: NewUser, meta: {requiresAuth: true}
    },
    /********************************************************************************************************/
    {
        path: '/dates', name: 'dates', component: Dates, meta: {requiresAuth: true}
    },
    {
        path: '/charts', name: 'charts', component: Charts, meta: {requiresAuth: true}
    },
    /********************************************************************************************************/
    {
        path: '/auth/login',
        component: Login,
        name: 'login',
        meta: {
            default: false,
            title: 'Login'
        }
     },


    {
        path : 'dashboard', 
        components:{
            default: Dashboard
        }
    },


    




/*
    // // UI Components
    { path : '/components/buttons', name: 'buttons', component: Buttons },
    { path : '/components/badges', name: 'badges', component: Badges },
    { path : '/components/socials', name: 'socials', component: Socials },

    { path : '/components/cards', name: 'cards', component: Cards },
    { path : '/components/modals', name: 'modals', component: Modals },
    { path : '/components/alerts', name: 'alerts', component: Alerts },
    { path : '/components/progressbars', name: 'progressbars', component: ProgressBars },
    { path : '/components/basic-form', name: 'basic-form', component: BasicForms },
    { path : '/components/grids', name: 'grids', component: Grids },
    { path : '/components/widgets', name: 'widgets', component: Widgets },
    { path : '/components/typography', name: 'typography', component: Typography },
    { path : '/components/tables', name: 'tables', component: Tables },

    {
        path : '/components/icons',
        component: Icons,
        children:[
            {
                path: '',
                component: SetsList,
                name: 'Icons'
            },
            {
                path: ':name',
                component: Sets,
                props: true,

            }
        ]
    },
    {
        path : '/components/charts',
        name: 'Charts',
        component: { render (c) { return c('router-view') }},
        children:[

            {
                path: '/components/chartjs',
                component: ChartJS,
                name: 'chart-js'
            },
            {
                path: '/components/flotchart',
                component: FlotChart,
                name: 'flotchart'
            }

        ]
    },
    {
        path : '/components/maps',
        name: 'Maps',
        component: { render (c) { return c('router-view') }},
        children:[
            {
                path: '/components/maps/google-maps',
                component: GoogleMapsPage,
                name: 'google-maps-page'
            },
            {
                path: '/components/maps/leaflet-maps',
                component: LeafletMapsPage,
                name: 'leaflet-maps-page'
            }
        ]
    },
    {
        path : '/components/auth',
        name: 'auth',
        component: { render (c) { return c('router-view') }},
        children:[
            {
                path: '/auth/login',
                component: Login,
                name: 'login',
                meta: {
                    default: false,
                    title: 'Login'
                }
            },
            {
                path: '/auth/register',
                component: Register,
                name: 'Register'
            },
            {
                path: '/auth/Page404',
                component: Page404,
                name: 'Page404'
            },
            {
                path: '/auth/Page500',
                component: Page500,
                name: 'Page500'
            }

        ]
    },*/

    //Redirect to Home
    ///{ path: '/redirect-me', redirect: { name: 'home' } },

    // 404 redirect to home
   /// { path: '*', redirect: { name: 'Page404', component: Page404 }  }
];