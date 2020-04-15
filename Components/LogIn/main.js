$(document).ready(function () {
  console.log("El Sistema ha iniciado");

  new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
      valid: true,
      name: "",
      nameRules: [
        (v) => !!v || "El nombre de usuario es requerido",
        (v) =>
        (v && v.length <= 25) ||
          "El nombre no puede pasar de los 10 caracteres",
      ],
      show1: false,
      show2: true,
      show3: false,
      show4: false,
      password: "",
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => v.length >= 8 || "Minimo 8 caracteres",
        emailMatch: () => "The email and password you entered don't match",
      },
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      select: null,
      items: [
        'Item 1',
        'Item 2',
        'Item 3',
        'Item 4',
      ],
      checkbox: false,
      lazy: false,
    }),

    methods: {
      validate() {
        if (this.$refs.form.validate()) {
          this.snackbar = true;
        }
      },
      reset() {
        this.$refs.form.reset();
      },
    },

  });
});
