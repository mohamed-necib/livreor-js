export default class Connexion {
  constructor(root) {
    root.innerHTML = Connexion.getHTML();

    this.el = {
      connexionBtn: document.getElementById("connect"),
      loginInput: document.getElementById("login"),
      pwdInput: document.getElementById("password"),
      connexionForm: document.getElementById("logForm"),
      successMessage: document.getElementById("connexion"),
    }

    this.el.connexionBtn.addEventListener("click", async (e) => {
      e.preventDefault();
      this.connection();
    })
  }

  //DECLARATIONS DES FONCTIONS UTILISEES

  connection() {
    fetch("index.php", {
      method: "POST",
      body: new FormData(this.el.connexionForm),
    })
      .then((resp) => {
        if (resp.ok) {
          return resp.json();
        }
      })
      .then((json) => {
        if (json["response"] == "ok_connexion") {
          this.el.successMessage.innerHTML = json["message"];
          this.el.connexionForm.innerHTML = json["messageConnexion"];
          this.el.connexionForm.style.color = "#FAC9B8";
          //TODO => Mettre en place message d'erreur
        }
      });
  }

  static getHTML() {
    return `
    <div class="form-container login-container">
            <form action="#" method="post" id="logForm">
                <h1>Bienvenue</h1>
                <input type="text" name="login" id="login" placeholder="Pseudo" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <span class="error" id="error"></span>
                <button type="submit" id="connect">Se connecter</button>
                <span id="connexion"></span>
            </form>
    </div>
    
    `
  }
}