$(document).ready(function () {
    console.log("El sistema ha iniciado...");
  
    // vue
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      data: () => ({
        dialog: false,
        drawer: null,
        itemsNav: [
          { icon: 'mdi-home', text: 'Inicio' },
          
          {
            icon: 'mdi-account-cog',
            'icon-alt': 'mdi-account-cog',
            text: 'Opciones',
            model: false,
            children: [
              { icon: 'mdi-account', text: 'Usuarios', href: 'Components/SignUp/' },
              { icon: 'mdi-account', text: 'Sesiones Activas' },
            ],
          },
          {
            icon: 'mdi-package-variant-closed',
            'icon-alt': 'mdi-package-variant-closed',
            text: 'Inventario',
            model: false,
            children: [
              { icon: 'mdi-package-variant', text: 'Categoria 1' },
              { icon: 'mdi-package-variant', text: 'Categoria 2' },
              { icon: 'mdi-package-variant', text: 'Categoria 3' },
              { icon: 'mdi-package-variant', text: 'Inventario General', href: 'Components/Inventory/' }
            ],
          },
          {
            icon: 'mdi-file-chart',
            'icon-alt': 'mdi-file-chart',
            text: 'Reportes',
            model: false,
            children: [
              { icon: 'mdi-file-download', text: 'Reportes de Salidas', href: 'Components/Exit/' },
              { icon: 'mdi-file-move', text: 'Reportes de Entradas', href: 'Components/Entry/' },
            ],
          },
          {
            icon: 'mdi-file-clock',
            'icon-alt': 'mdi-file-clock',
            text: 'Tareas',
            model: false,
            children: [
              { icon: 'mdi-file-check', text: 'Tareas', href: 'Components/Task/' },

            ],
          },
        ],

        // Cards
        labels: [
            '12am',
            '3am',
            '6am',
            '9am',
            '12pm',
            '3pm',
            '6pm',
            '9pm',
          ],
          value: [
            200,
            675,
            410,
            390,
            310,
            460,
            250,
            240,
        ],
      }),
  
      
    });
  
  });
    