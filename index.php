<?  include ('cms.dat.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <h2>Chat (pas l'animal - mais une version amélioré de telegram)</h2>
  <style>
    #chat { height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; }
    input, button { margin-top: 10px; }
  </style>
  <link rel="stylesheet" type="text/css" id="theme" href="css.css" />

</head>
<body>
  <div id="chat"></div>
  <p class="flotte">
    <h3>Utilisateurs connectés</h3>
  </p>
  <p style="line-height:65px;">
    <ul id="users"></ul>
  </p>	

  <input type="text" id="username" placeholder="Votre nom">
  <input type="text" id="message" placeholder="Votre message">
  <button onclick="sendMessage()">Envoyer</button>

  <script>
    function sendMessage() {
      const user = document.getElementById("username").value;
      const msg = document.getElementById("message").value;
      if (!user || !msg) return;

      fetch("send.php", {
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `user=${encodeURIComponent(user)}&msg=${encodeURIComponent(msg)}`
      }).then(() => {
        document.getElementById("message").value = "";
      });
    }

    let lastMessageTime = Date.now();
    let lastMessage = ""; // contient le dernier message vu

    function loadMessages() {
      fetch("get_messages.php")
        .then(response => response.text())
        .then(data => {
          const chatBox = document.getElementById("chat");

          // Extraire le dernier message visible
          const lines = data.trim().split("\n");
          const currentLastMessage = lines[lines.length - 1] || "";

          if (currentLastMessage !== lastMessage) {
            const now = Date.now();

            if (now - lastMessageTime > 60000) {
              const alertSound = document.getElementById("alertSound");
              alertSound.play();
            }

            lastMessageTime = now;
            lastMessage = currentLastMessage;
            chatBox.innerHTML = data;
            chatBox.scrollTop = chatBox.scrollHeight;
          }
        });
    }





    setInterval(loadMessages, 6000); // rafraîchit le chat chaque seconde


    // ajout user connected 
    function updateUser() {
      const user = document.getElementById("username").value;
      if (!user) return;

      fetch("update_user.php", {
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `username=${encodeURIComponent(user)}`
      });
    }

    function loadUsers() {
      fetch("get_users.php")
        .then(response => response.json())
        .then(data => {
          const usersList = document.getElementById("users");
          usersList.innerHTML = "";
          data.forEach(user => {
            const li = document.createElement("li");
            li.textContent = user + " (en ligne)";
            li.classList.add("online"); // applique la classe verte
            usersList.appendChild(li);
          });

        });
    }
    setInterval(() => {
      updateUser();
      loadUsers();
    }, 30000); // toutes les 30 secondes
    </script>
    
    
    <audio id="alertSound" src="Rifle Shot With Shells.mp3" preload="auto"></audio>
    <!--   *"Rifle Shot With Shells.mp3"   "windows44"-->
</body>
</html>
