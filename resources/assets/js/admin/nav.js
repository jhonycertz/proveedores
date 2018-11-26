var nav;
if (localStorage.getItem('charge') == 0) {
  nav = {
    items: [
      {
        name: 'Dashboard',
        url: '/',
        icon: 'fa fa-dashboard',
        badge: {
          variant:'success',
        }
      },
      {
        name: 'Configuración',
        url: '/components',
        icon: 'fa fa-puzzle-piece',
        children: [
          {
            name: 'Tipos de Incidencias',
            url: '/incidence-type',
            icon: 'fa fa-puzzle-piece',
          },
          {
            name: 'Tipos de Empresas',
            url: '/company-type',
            icon: 'fa fa-id-badge',
          },
          {
            name: 'Tipos de Documentos',
            url: '/document-type',
            icon: 'fa fa-id-badge',
          },
          {
            name: 'Tipos de Requerimientos',
            url: '/requeriment-type',
            icon: 'fa fa-id-badge',
          },
          {
            name: 'Requerimientos',
            url: '/requeriment',
            icon: 'fa fa-id-badge',
          }
        ]
      },
      {
        name: 'Empresas',
        url: '/companies',
        icon: 'fa fa-table',
        children: [
          { 
            name: 'Nuevas',
            url: '/companies/news',
            icon: 'fa fa-pencil-square-o'
          },
          { 
            name: 'En Proceso',
            url: '/companies/enproceso',
            icon: 'fa fa-pencil-square-o',
         },
         { 
          name: 'Rechazadas',
          url: '/companies/rechazada',
          icon: 'fa fa-pencil-square-o',
       },
         { 
            name: 'Aprobadas',
            url: '/companies/aprobadas',
            icon: 'fa fa-pencil-square-o',
         }
       ]
      },
      {
        name: 'Atención al cliente',
        url: '/components/tables',
        icon: 'fa fa-users',
        children: [
          { 
            name: 'Preguntas',
            url: '/question',
            icon: 'fa fa-pencil-square-o',
         }
       ]
      },
      {
        name: 'Reportes',
        url: 'charts',
        icon: 'fa fa-bar-chart'
      },
      {
        name: 'Citas',
        url: 'dates',
        icon: 'fa fa-calendar'
      },
      {
        name: 'Administracion del Sistema',
        url: '/components/tables',
        icon: 'fa fa-cogs',
        children: [
        { 
          name: 'Seguridad',
          icon: 'fa fa-lock',
          children:[
            {
                name: 'Rol',
                url: 'roles'
            },
            {name: 'Usuario', url: 'users'}
          ]
        }
       ]
      }
  
    ]
  }
}else{
    nav = {
        items: [{
                name: 'Dashboard',
                url: '/',
                icon: 'fa fa-dashboard',
                badge: {
                    variant: 'success'
                }
            },
            {
                name: 'Configuración',
                url: '/components',
                icon: 'fa fa-puzzle-piece',
                children: [
                    {
                        name: 'Tipos de Requerimientos',
                        url: '/requeriment-type',
                        icon: 'fa fa-id-badge',
                    },
                    {
                        name: 'Requerimientos',
                        url: '/requeriment',
                        icon: 'fa fa-id-badge',
                    }
                ]
            },
            {
                name: 'Empresas',
                url: '/companies',
                icon: 'fa fa-table',
                children: [{
                        name: 'Nuevas',
                        url: '/companies/news',
                        icon: 'fa fa-pencil-square-o'
                    },
                    {
                        name: 'En Proceso',
                        url: '/companies/enproceso',
                        icon: 'fa fa-pencil-square-o',
                    },
                    {
                        name: 'Rechazadas',
                        url: '/companies/rechazada',
                        icon: 'fa fa-pencil-square-o',
                    },
                    {
                        name: 'Aprobadas',
                        url: '/companies/aprobadas',
                        icon: 'fa fa-pencil-square-o',
                    }
                ]
            },
            {
                name: 'Atención al cliente',
                url: '/components/tables',
                icon: 'fa fa-users',
                children: [{
                    name: 'Preguntas',
                    url: '/question',
                    icon: 'fa fa-pencil-square-o',
                }]
            },
        ]
    }
}

export default nav;