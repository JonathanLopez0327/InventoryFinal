$(document).ready(function() {
  console.log("El sistema ha iniciado...");

  var url = "../../Backend/Task/index.php";
  // Fecha actual
  var f = new Date();
  var fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();

  // vue
  new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
      dialog: false,
      drawer: null,
      sheet: false,
      search: "",
      dialog: false,

      snackbar: false,
      textSnack: "texto snackbar",
      itemsNav: [
        { icon: "mdi-home", text: "Inicio", href: "../../" },

        {
          icon: "mdi-account-cog",
          "icon-alt": "mdi-account-cog",
          text: "Opciones",
          model: false,
          children: [
            { icon: "mdi-account", text: "Usuarios", href: "../SignUp/" },
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
            {
              icon: "mdi-package-variant",
              text: "Inventario General",
              href: "../Inventory/"
            }
          ]
        },
        {
          icon: "mdi-file-chart",
          "icon-alt": "mdi-file-chart",
          text: "Reportes",
          model: false,
          children: [
            {
              icon: "mdi-file-download",
              text: "Reportes de Salidas",
              href: "../Exit/"
            },
            {
              icon: "mdi-file-move",
              text: "Reportes de Entradas",
              href: "../Entry/"
            }
          ]
        },
        {
          icon: "mdi-calendar",
          "icon-alt": "mdi-calendar",
          text: "Tareas",
          model: true,
          children: [{ icon: "mdi-calendar-check", text: "Tareas" }]
        }
      ],

      // Combobox
      items: ["Urgente", "Normal"],

      itemsOrinted: ["Inventario", "Reporte", "Otra"],

      // Datatable
      headers: [
        {
          text: "ID",
          align: "left",
          sortable: false,
          value: "ID_TASK"
        },
        { text: "Tarea", value: "TASK" },
        { text: "Orientacion de la Tarea", value: "ORIENTED_TO" },
        { text: "Opciones", value: "pepe", sortable: false },
        { text: "Fecha de Creacion", value: "DATE_TASK" },
        { text: "Opciones", value: "accion", sortable: false },
      ],

      task: [],

      editedIndex: -1,

      editado: {
        ID_TASK: "",
        TASK: "",
        TASK_DESCRIPTION: "",
        CATEGORY_TASK: "",
        ORIENTED_TO: "",
        DATE_TASK: ""
      },

      defaultItem: {
        ID_TASK: "",
        TASK: "",
        TASK_DESCRIPTION: "",
        CATEGORY_TASK: "",
        ORIENTED_TO: "",
        DATE_TASK: ""
      }

      // Fin data
    }),

    // Funciones y Metodos
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
      // Enlistame todo
      this.listTask();
      // Llama cada segundo a la funcion
      this.realTask();
    },

    // Metodos

    methods: {
      // Categoriad de la tarea

      getColor(CATEGORY_TASK) {
        if (CATEGORY_TASK == "Urgente") return "red";
        else if (CATEGORY_TASK == "Normal") return "green";
        else return "gray";
      },

      // Listar Tareas
      listTask: function() {
        axios.post(url, { opcion: 4 }).then(response => {
          this.task = response.data;
        });
      },

      // Real Time(Lo llama cada segundo)
      realTask() {
        setInterval(this.listTask, 1000);
      },

      // Guardar la tarea

      saveTask: function() {
        axios
          .post(url, {
            opcion: 1,
            TASK: this.TASK,
            TASK_DESCRIPTION: this.TASK_DESCRIPTION,
            CATEGORY_TASK: this.CATEGORY_TASK,
            ORIENTED_TO: this.ORIENTED_TO,
            DATE_TASK: fecha
          })
          .then(response => {
            this.listTask();
          });

        this.TASK = "";
        this.TASK_DESCRIPTION = "";
        this.CATEGORY_TASK = "";
        this.ORIENTED_TO = "";
        this.DATE_TASK = "";
      },

      // Edit task

      editTask: function(
        ID_TASK,
        TASK,
        TASK_DESCRIPTION,
        CATEGORY_TASK,
        ORIENTED_TO,
        DATE_TASK
      ) {
        axios
          .post(url, {
            opcion: 2,
            ID_TASK: ID_TASK,
            TASK: TASK,
            TASK_DESCRIPTION: TASK_DESCRIPTION,
            CATEGORY_TASK: CATEGORY_TASK,
            ORIENTED_TO: ORIENTED_TO,
            DATE_TASK: DATE_TASK
          })
          .then(response => {
            this.listTask();
          });
      },

      // DeleteTask
      deleteTask: function(ID_TASK) {
        axios.post(url, { opcion: 3, ID_TASK: ID_TASK }).then(response => {
          this.listTask();
        });
      },

      // Obten los datos
      editar(itemData) {
        this.sheet = true;
        this.editedIndex = this.task.indexOf(itemData);
        this.editado = Object.assign({}, itemData);
      },

      check(itemData) {
        this.dialog = true;
        this.editedIndex = this.task.indexOf(itemData);
        this.editado = Object.assign({}, itemData);
      },

      // Eliminar completamente
      borrar(itemData) {
        const index = this.task.indexOf(itemData);

        console.log(this.task[index].ID_TASK); //capturo el id de la fila seleccionada
        var r = confirm("¿Está seguro de borrar estas tarea?");
        if (r == true) {
          this.deleteTask(this.task[index].ID_TASK);
          this.snackbar = true;
          this.textSnack = "Se eliminó las tarea.";
        } else {
          this.snackbar = true;
          this.textSnack = "Operación cancelada.";
        }
      },

      cancelar() {
        this.sheet = false;
        this.editado = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      },

      // Save completamente
      guardar() {
        if (this.editedIndex > -1) {
          //Guarda en caso de Edición
          this.ID_TASK = this.editado.ID_TASK;
          this.TASK = this.editado.TASK;
          this.TASK_DESCRIPTION = this.editado.TASK_DESCRIPTION;
          this.CATEGORY_TASK = this.editado.CATEGORY_TASK;
          this.ORIENTED_TO = this.editado.ORIENTED_TO;
          this.DATE_TASK = this.editado.DATE_TASK;

          this.snackbar = true;
          this.textSnack = "¡Actualización Exitosa!";
          this.editTask(
            this.ID_TASK,
            this.TASK,
            this.TASK_DESCRIPTION,
            this.CATEGORY_TASK,
            this.ORIENTED_TO,
            this.DATE_TASK
          );
        } else {
          //Guarda el registro en caso de Alta
          if (
            this.editado.TASK == "" ||
            this.editado.TASK_DESCRIPTION == "" ||
            this.editado.CATEGORY_TASK == "" ||
            this.editado.ORIENTED_TO == ""
          ) {
            this.snackbar = true;
            this.textSnack = "Datos incompletos.";
          } else {
            this.TASK = this.editado.TASK;
            this.TASK_DESCRIPTION = this.editado.TASK_DESCRIPTION;
            this.CATEGORY_TASK = this.editado.CATEGORY_TASK;
            this.ORIENTED_TO = this.editado.ORIENTED_TO;

            this.snackbar = true;
            this.textSnack = "¡Alta exitosa!";
            this.saveTask();
          }
        }
        this.cancelar();
      }

      // Fin metodos
    }
  });
});
