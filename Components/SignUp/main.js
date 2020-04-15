$(document).ready(function() {
  console.log("El sistema ha iniciado...");

  var url = "../../Backend/SignUp/index.php";

  // vue
  new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
      search: "",
      dialog: false,
      drawer: null,

      snackbar: false,
      textSnack: "texto snackbar",

      itemsNav: [
        { icon: "mdi-home", text: "Inicio", href: "../../" },

        {
          icon: "mdi-account-cog",
          "icon-alt": "mdi-account-cog",
          text: "Opciones",
          model: true,
          children: [
            { icon: "mdi-account", text: "Usuarios" },
            { icon: "mdi-account", text: "Sesiones Activas" }
          ]
        },
        {
          icon: "mdi-package-variant-closed",
          "icon-alt": "mdi-package-variant-closed",
          text: "Inventario",
          model: false,
          children: [
            { icon: "mdi-package-variant", text: "Categoria 1", href: '../Category1/' },
            { icon: "mdi-package-variant", text: "Categoria 2", href: '../Category2/' },
            { icon: "mdi-package-variant", text: "Categoria 3", href: '../Category3/' },
            { icon: "mdi-package-variant", text: "Inventario General", href: '../Inventory/' }
          ]
        },
        {
          icon: "mdi-file-chart",
          "icon-alt": "mdi-file-chart",
          text: "Reportes",
          model: false,
          children: [
            { icon: "mdi-file-download", text: "Reportes de Salidas", href: '../Exit/' },
            { icon: "mdi-file-move", text: "Reportes de Entradas", href: '../Entry/' },
          ]
        },
        {
          icon: "mdi-calendar",
          "icon-alt": "mdi-calendar",
          text: "Tareas",
          model: false,
          children: [{ icon: "mdi-calendar-check", text: "Tareas", href: '../Task/' }]
        }
      ],

      // DataTable
      headers: [
        {
          text: "ID",
          align: "left",
          sortable: false,
          value: "ID_USER"
        },
        { text: "Nombre", value: "NAME_USER" },
        { text: "Apellido", value: "LASTNAME_USER" },
        { text: "Tipo", value: "TYPE_USER" },
        { text: "Usuario", value: "USER_NAME" },
        { text: "Opciones", value: "accion", sortable: false }
      ],

      usuarios: [],
      editedIndex: -1,
      editado: {
        ID_USER: "",
        NAME_USER: "",
        LASTNAME_USER: "",
        TYPE_USER: "",
        USER_NAME: "",
        PASS_USER: ""
      },
      defaultItem: {
        ID_USER: "",
        NAME_USER: "",
        LASTNAME_USER: "",
        TYPE_USER: "",
        USER_NAME: "",
        PASS_USER: ""
      }
    }),

    // Funciones

    computed: {
      //Dependiendo si es Alta o Edición cambia el título del modal
      formTitle() {
        //operadores condicionales "condición ? expr1 : expr2"
        // si <condicion> es true, devuelve <expr1>, de lo contrario devuelve <expr2>
        return this.editedIndex === -1
          ? "Agregar Nuevo Usuario"
          : "Modificar Informacion";
      }
    },

    watch: {
      dialog(val) {
        val || this.cancelar();
      }
    },

    created() {
      this.listarMoviles();
      this.rtdb();
    },

    // Metodos

    methods: {
      //PROCEDIMIENTOS para el CRUD

      //Procedimiento Listar moviles
      listarMoviles: function() {
        axios.post(url, { opcion: 4 }).then(response => {
          this.usuarios = response.data;
        });
      },
      //Procedimiento Alta de moviles.
      altaMovil: function() {
        axios
          .post(url, {
            opcion: 1,
            NAME_USER: this.NAME_USER,
            LASTNAME_USER: this.LASTNAME_USER,
            TYPE_USER: this.TYPE_USER,
            USER_NAME: this.USER_NAME,
            PASS_USER: this.PASS_USER
          })
          .then(response => {
            this.listarMoviles();
          });
        (this.NAME_USER = ""),
          (this.LASTNAME_USER = ""),
          (this.TYPE_USER = ""),
          (this.USER_NAME = ""),
          (this.PASS_USER = "");
      },
      //Procedimiento EDITAR.
      editarMovil: function(
        ID_USER,
        NAME_USER,
        LASTNAME_USER,
        TYPE_USER,
        USER_NAME,
        PASS_USER
      ) {
        axios
          .post(url, {
            opcion: 2,
            ID_USER: ID_USER,
            NAME_USER: NAME_USER,
            LASTNAME_USER: LASTNAME_USER,
            TYPE_USER: TYPE_USER,
            USER_NAME: USER_NAME,
            PASS_USER: PASS_USER
          })
          .then(response => {
            this.listarMoviles();
          });
      },
      //Procedimiento BORRAR.
      borrarMovil: function(ID_USER) {
        axios.post(url, { opcion: 3, ID_USER: ID_USER }).then(response => {
          this.listarMoviles();
        });
      },
      editar(itemData) {
        this.editedIndex = this.usuarios.indexOf(itemData);
        this.editado = Object.assign({}, itemData);
        this.dialog = true;
      },
      borrar(itemData) {
        const index = this.usuarios.indexOf(itemData);

        console.log(this.usuarios[index].ID_USER); //capturo el id de la fila seleccionada
        var r = confirm("¿Está seguro de borrar el registro?");
        if (r == true) {
          this.borrarMovil(this.usuarios[index].ID_USER);
          this.snackbar = true;
          this.textSnack = "Se eliminó el registro.";
        } else {
          this.snackbar = true;
          this.textSnack = "Operación cancelada.";
        }
      },

      rtdb() {
        setInterval(this.listarMoviles, 1000);
      },

      cancelar() {
        this.dialog = false;
        this.editado = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      },

      guardar() {
        if (this.editedIndex > -1) {
          //Guarda en caso de Edición
          this.ID_USER = this.editado.ID_USER;
          this.NAME_USER = this.editado.NAME_USER;
          this.LASTNAME_USER = this.editado.LASTNAME_USER;
          this.TYPE_USER = this.editado.TYPE_USER;
          this.USER_NAME = this.editado.USER_NAME;
          this.PASS_USER = this.editado.PASS_USER;

          this.snackbar = true;
          this.textSnack = "¡Actualización Exitosa!";
          this.editarMovil(
            this.ID_USER,
            this.NAME_USER,
            this.LASTNAME_USER,
            this.TYPE_USER,
            this.USER_NAME,
            this.PASS_USER
          );
        } else {
          //Guarda el registro en caso de Alta
          if (
            this.editado.NAME_USER == "" ||
            this.editado.LASTNAME_USER == "" ||
            this.editado.TYPE_USER == "" ||
            this.editado.USER_NAME == "" ||
            this.editado.USER_NAME == ""
          ) {
            this.snackbar = true;
            this.textSnack = "Datos incompletos.";
          } else {
            this.ID_USER = this.editado.ID_USER;
            this.NAME_USER = this.editado.NAME_USER;
            this.LASTNAME_USER = this.editado.LASTNAME_USER;
            this.TYPE_USER = this.editado.TYPE_USER;
            this.USER_NAME = this.editado.USER_NAME;
            this.PASS_USER = this.editado.PASS_USER;

            this.snackbar = true;
            this.textSnack = "¡Alta exitosa!";
            this.altaMovil();
          }
        }
        this.cancelar();
      }
      // fin
    }
  });
});
