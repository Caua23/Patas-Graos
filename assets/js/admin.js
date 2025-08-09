const header = document.querySelector('header');
const aside = document.querySelector('aside');
const main = document.querySelector('main');

aside.style.marginTop = header.offsetHeight + 'px';
main.style.marginTop = header.offsetHeight + 'px';
main.style.marginLeft = aside.offsetWidth + 'px';

async function deleteProduct(id) {
    const pathName = window.location.pathname; 
    const projectName = pathName.split("/").filter(Boolean)[0];
    const response = await fetch(`http://localhost/${projectName}/api/products/delete/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
    });
    if (response.ok) {
        location.reload();
    } else {
        const error = await response.json();
        alert(`Error: ${error.message}`);
    }
}

async function updateProduct(id, data) {
    const pathName = window.location.pathname; 
    const projectName = pathName.split("/").filter(Boolean)[0];
    const response = await fetch(`http://localhost/${projectName}/api/products/update/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    if (response.ok) {
        location.reload();
    } else {
        const error = await response.json();
        alert(`Error: ${error.message}`);
    }
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

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".product-form");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const productId = form.getAttribute("data-product-id");
        if (!productId) {
            alert("Produto não selecionado para atualização.");
            return;
        }

        const formData = new FormData(form);
        const data = {
            name: formData.get("name"),
            description: formData.get("description"),
            price: parseFloat(formData.get("price")) || 0,
            img: formData.get("img"),
            category: formData.get("category"),
            amount: parseInt(formData.get("amount")) || 0
        };

        await updateProduct(productId, data);
    });
});
