<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Announcement Popup</title>
<style>
  body {
    margin: 0; padding: 0;
    font-family: Arial, sans-serif;
    background: #7a1cc0; /* Purple background similar to screenshot */
  }

  /* Overlay backdrop dims the background */
  #popupOverlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  /* The popup container */
  #popupBox {
    background: #f67f07; /* Orange */
    border: 4px solid blue;
    border-radius: 10px;
    max-width: 600px;
    width: 90%;
    padding: 30px 40px;
    box-sizing: border-box;
    text-align: center;
    color: black;
    box-shadow: 0 0 15px 4px rgba(0,0,255,0.5);
  }

  #popupBox h1 {
    margin-top: 0;
    font-size: 2.5rem;
    font-weight: 900;
  }

  #popupBox p {
    margin: 12px 0;
    font-weight: 600;
    font-size: 1.1rem;
    line-height: 1.4;
  }

  #popupBox p a {
    color: black;
    text-decoration: underline;
    cursor: pointer;
  }

  #acceptBtn {
    margin-top: 20px;
    background: #ff0a00; /* bright red */
    color: white;
    border: none;
    padding: 14px 28px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1.2rem;
    cursor: pointer;
    user-select: none;
    transition: background 0.3s ease;
  }

  #acceptBtn:hover {
    background: #cc0800;
  }
</style>
</head>
<body>

<div id="popupOverlay">
  <div id="popupBox" role="alert" aria-modal="true" aria-labelledby="popupTitle" aria-describedby="popupDesc">
    <h1 id="popupTitle">!!ANOUNCEMENT!!</h1>
    <p id="popupDesc">
      Tambola is legal game in India and falls under skill base game.<br>
      Incase if system failure during the game there will be re-game.<br>
      In case of re-game ticket can not be cancelled.<br>
      This website is starttambola.com certified and it’s a legit website.<br>
      Check legitimacy by clicking <a href="https://starttambola.com" target="_blank" rel="noopener noreferrer">here</a>.
    </p>
    <button id="acceptBtn" aria-label="Accept announcement and close popup">I ACCEPT</button>
  </div>
</div>

<script>
  const popupOverlay = document.getElementById('popupOverlay');
  const acceptBtn = document.getElementById('acceptBtn');

  acceptBtn.addEventListener('click', () => {
    popupOverlay.style.display = 'none';
  });

  // Optional: Prevent interaction with rest of page while popup is open
  // You can add more logic like storing "accepted" in localStorage if needed
</script>

</body>
</html>
