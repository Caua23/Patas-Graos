function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = `${name}=${encodeURIComponent(value)}${expires}; path=/`;
}
document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname;
  const projectName = pathName.split("/").filter(Boolean)[0];

  const form = document.getElementById("form");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const email = formData.get("email");
    const password = formData.get("password");

    try {
      const response = await fetch(`http://localhost/${projectName}/api/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ email, password })
      });

      const data = await response.json();

      if (!response.ok) {
        alert(`Error: ${data.message || "Erro no login"}`);
        return;
      }

      console.log(data);
      setCookie("id", data.user.id, 7);
      window.location.href = `http://localhost/${projectName}${data.redirect}`;

    } catch (err) {
      console.error("Erro na requisição:", err);
      alert("Erro de conexão com o servidor.");
    }
  });
});
