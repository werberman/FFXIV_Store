// const dataArray = [{ item: 'Item 1', rating: 3, price: 300.00, title: 'TITLE 1', id: 'id1' }, { item: 'Item 2', rating: 4, price: 400, title: 'TITLE 2', id: 'id2' }, 
// { item: 'Item 3', rating: 5, price: 700, title: 'TITLE 3', id: 'id3' },
// { item: '10x Castrum Marinum Runs', rating: 5, price: 200, title: 'Emerald Weapon', id: 'id4'}, { item: 'Castrum Marinum Mount', rating: 4, price: 300.00, title: 'Emerald Mount', id: 'id5'},
// { item: "Eden's Promise: Umbra (Savage)", rating: 4, price: 500.00, title: 'E9S', id: 'id6'}];

// /******************* Object list for product search ************************/
// const html = `<div class="list_container">
// <img src="https://via.placeholder.com/50x50">
// <div class="prod_title">TOREPLACETITLE</div>
// <div class="description">TOREPLACEITEM</div>
// <div class="rating">
//     TOREPLACESTARS
// </div>
// <div class="price" id='TOREPLACEID2'>TOREPLACEINITIALPRICE</div>
// <span class="cart_wrapper">
//     <span class="quantity_selector" id=>
//     <input type="number" id="TOREPLACEID1" onchange="getTotalPrice(TOREPLACEPRICE, 'TOREPLACEID1', 'TOREPLACEID2')" name="quantity" min="1" size="2" value="0">
//     </input>
//     </span>
//     <button type="add_to_cart">Add to Cart</button>
// </span>
// </div>`;
// setTimeout(() => { setHtml() }, 50);

/************** Main replacement function ******************/
// function setHtml(arr) {
//     if (!arr) { arr = dataArray; }
//     const template = document.getElementById('template');
//     var fullHtml = '';
//     arr.forEach(value => {
//         fullHtml += html.replace('TOREPLACEITEM', value.item)
//             .replace('TOREPLACESTARS', setStars(value.rating))
//             .replace('TOREPLACETITLE', value.title)
//             .replace('TOREPLACEPRICE', value.price)
//             .replace('TOREPLACEINITIALPRICE', "$" + value.price + ".00")
//             //doubled to account for the fact that it will only replace the first instance if not repeated.
//             .replace('TOREPLACEID1', value.id)
//             .replace('TOREPLACEID1', value.id)
//             .replace('TOREPLACEID2', value.id + "_2")
//             .replace('TOREPLACEID2', value.id + "_2");

//     });
//     template.innerHTML = fullHtml;
// }
/******************* Raiting System **************************/
function setStars(stars) {
    var starHtml = '';

    [1, 2, 3, 4, 5].forEach(value => {
        starHtml += value <= stars ?
            '<span class="fa fa-star checked"></span>'
            : '<span class="fa fa-star"></span>'
    })

    return starHtml;
}
