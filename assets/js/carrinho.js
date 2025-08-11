const header = document.querySelector('header');
const main = document.querySelector('main');


main.style.paddingTop = header.offsetHeight + 'px';
const pathName = window.location.pathname;
const projectName = pathName.split("/").filter(Boolean)[0];

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const payment = formData.get("payment");
    

    try {
      const response = await fetch(`http://localhost/${projectName}/api/carrinho/checkout`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ payment })
      });

      const data = await response.json();

      if (!response.ok) {
        alert(`Error: ${data.message || "erro em pedir"}`);
        return;
      }

      console.log(data);
      window.location.href = `http://localhost/${projectName}${data.redirect}${data.total}`;

    } catch (err) {
      console.error("Erro na requisição:", err);
      alert("Erro de conexão com o servidor.");
    }
  });
});
