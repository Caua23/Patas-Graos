const header = document.querySelector('header');
const aside = document.querySelector('aside');
const main = document.querySelector('main');

aside.style.marginTop = header.offsetHeight + 'px';
main.style.marginTop = header.offsetHeight + 'px';
main.style.marginLeft = aside.offsetWidth + 'px';

const pathName = window.location.pathname;
const projectName = pathName.split("/").filter(Boolean)[0];

async function deleteProduct(id) {
    const response = await fetch(`http://localhost/${projectName}/api/products/delete/${id}`, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' }
    });

    const result = await response.json();
    if (response.ok) {
         location.reload();
    } else {
        alert(`Error: ${result.error}`);
    }
}


async function updateProduct(id, data) {
    const response = await fetch(`http://localhost/${projectName}/api/products/update/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    if (response.ok) {
        location.reload();
    } else {
        alert(`Error: ${result.error}`);
    }
}


async function createProduct(data) {
    const response = await fetch(`http://localhost/${projectName}/api/products/create`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    if (!response.ok) {
        alert(`Error: ${result.error}`);
        return;
    }
    hiddenProduct();
    alert(`Produto criado com sucesso!`);
    console.log("Produto criado:", result);
}
function getCookie(name) {
    const cookies = document.cookie.split("; ");
    for (let c of cookies) {
        const [cookieName, cookieValue] = c.split("=");
        if (cookieName === name) {
            return decodeURIComponent(cookieValue);
        }
    }
    return null;
}

function showProduct() {
    const form = document.querySelector(".addProduct-form");
    if (form) form.classList.remove("hidden");
}

function hiddenProduct() {
    const form = document.querySelector(".addProduct-form");
    if (form) form.classList.add("hidden");
}

function hiddenUpdateProduct() {
    const form = document.querySelector(".product-form");
    if (!form) return;
    form.classList.add("hidden");
    form.removeAttribute("data-product-id");
    form.reset();
}

function showUpdateProduct(id) {
    const form = document.querySelector(".product-form");
    if (!form) return;
    
    form.setAttribute("data-product-id", id);
    form.classList.remove("hidden");
}

document.addEventListener("DOMContentLoaded", () => {
    const addForm = document.querySelector(".addProduct-form");
    const idAdmin = getCookie("id")
    if (addForm && idAdmin) {
        addForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const formData = new FormData(addForm);
            const data = {
                name: formData.get("name"),
                description: formData.get("description"),
                price: parseFloat(formData.get("price")) || 0,
                img: formData.get("img"),
                category: formData.get("category"),
                amount: formData.get("amount"),
                id_adm: idAdmin
            };
            await createProduct(data);
        });
    }

    const updateForm = document.querySelector(".product-form");
    if (updateForm) {
        updateForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const productId = updateForm.getAttribute("data-product-id");
            if (!productId) {
                alert("Produto não selecionado para atualização.");
                return;
            }
            const formData = new FormData(updateForm);
            const data = {
                name: formData.get("name"),
                description: formData.get("description"),
                price: parseFloat(formData.get("price")) || 0,
                img: formData.get("img"),
                category: formData.get("category"),
                amount: formData.get("amount")
            };
            await updateProduct(productId, data);
        });
    }
});
