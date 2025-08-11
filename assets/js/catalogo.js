const header = document.querySelector('header');
const aside = document.querySelector('aside');
const main = document.querySelector('main');

aside.style.marginTop = header.offsetHeight + 'px';
main.style.marginTop = header.offsetHeight + 'px';
main.style.marginLeft = aside.offsetWidth + 'px';

const pathName = window.location.pathname;
const projectName = pathName.split("/").filter(Boolean)[0];

async function comprar(id){
    try {
        
        const response = await fetch(`http://localhost/${projectName}/api/carrinho/add`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify( {idProduto: id, quantidade: 1})
        });
        const result = await response.json();

        if(!response.ok){
            alert(`Error: ${result.error}`);
            return;
        }
        console.log(result);
        

    } catch (error) {
        console.log(error);
        
    }
}