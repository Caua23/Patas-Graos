document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname; // "/Patas-Graos/index.html"
  const projectName = pathName.split("/").filter(Boolean)[0];
  console.log(projectName); // "Patas-Graos"

  const form = document.getElementById("form");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const email = formData.get("email");
    const password = formData.get("password");
    
    const response = await fetch(`http://localhost/${projectName}/api/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ email, password })
    })
    const textResponse = await response.text();
    if(!response.ok) {
      const errorData = await response.json();
      alert(`Error: ${errorData.message}`);
      return;
    }
    const data = JSON.parse(textResponse);
    console.log(data.redirect);
    
    return window.location.href = `http://localhost/${projectName}${data.redirect}`;
    
  });
});
