export default class Inscription {
  constructor(root) {
    root.innerHTML = Inscription.getHTML();

    this.el = {
      inscriptionBtn: document.getElementById("create"),
      loginInput: document.getElementById("login"),
      pwdInput: document.getElementById("password"),
      confPwdInput: document.getElementById("conf-password"),
      inscriptionForm: document.getElementById("createForm"),
      successMessage: document.getElementById("creation"),
    };

    this.el.inscriptionBtn.addEventListener("click", async (e) => {
      e.preventDefault();
      this.register();
    });
  }

  // DECLARATIONS DES FONCTIONS UTILISEES

  register() {
    fetch("index.php", {
      method: "POST",
      body: new FormData(this.el.inscriptionForm),
    })
      .then((resp) => {
        if (resp.ok) {
          return resp.json();
        }
      })
      .then((json) => {
        if (json["response"] == "is_ok") {
          this.el.successMessage.innerHTML = json["message"];
          this.el.inscriptionForm.innerHTML = json["messageInscription"];
          this.el.successMessage.style.color = "#FAC9B8";
          //TODO => METTRE MESSAGE D'ERREUR
        }
      });
  }

  static getHTML() {
    return `
    <div class="form-container sign-up-container">
        <form method="post" id="createForm">
          <h1>INSCRIPTION</h1>
          <input type="text" name="login" id="login" required>
          <span id="error" class="error"> </span>
          <input type="password" name="password" id="password" required>
          <input type="password" name="conf-password" 
          id="conf-password" required>
          <span id="error" class="error"> </span>
          <button type="submit" id="create">Inscription</button>
          <span id="creation"> </span>
        </form>
      </div>
    `;
  }
}
