const dataArray = [{ item: 'Item 1', rating: 3, price: 300.00, title: 'TITLE 1' }, { item: 'Item 2', rating: 4, price: 400, title: 'TITLE 2' }, { item: 'Item 3', rating: 5, price: 700, title: 'TITLE 3' },
{ item: '10x Castrum Marinum Runs', rating: 5, price: 200, title: 'Emerald Weapon' }, { item: 'Castrum Marinum Mount', rating: 4, price: 300.00, title: 'Emerald Mount' },
{ item: "Eden's Promise: Umbra (Savage)", rating: 4, price: 500.00, title: 'E9S' }];

/******************* Object list for product search ************************/
const html = `<div class="list_container">
<img src="https://via.placeholder.com/50x50">
<div class="prod_title">TOREPLACETITLE</div>
<div class="description">TOREPLACEITEM</div>
<div class="rating">
    TOREPLACESTARS
</div>
<div class="price">TOREPLACEPRICE</div>
<span class="cart_wrapper">
    <span class="quantity_selector">
        <input type="number" id="quantity" name="quantity" min="1" size="2">
    </span>
    <button type="add_to_cart">Remove From Cart</button>
</span>
</div>`;
setTimeout(() => { sort() }, 50);

/************** Main replacement funtion ******************/
function setHtml(arr) {
    if (!arr) { arr = dataArray; }
    const template = document.getElementById('template');
    var fullHtml = '';
    arr.forEach(value => {
        fullHtml += html.replace('TOREPLACEITEM', value.item)
            .replace('TOREPLACESTARS', setStars(value.rating))
            .replace('TOREPLACETITLE', value.title)
            .replace('TOREPLACEPRICE', '$' + value.price);
    });
    template.innerHTML = fullHtml;
}
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

/********************** Sort Function ********************/
function sort(sortType) {
    var sort = sortType;
    var arr = dataArray;
    
    //sort by function (compare a to be and => sort according to this)
    //make sure that default is to sort a-z
    //impliment a switch for this section
    switch (sort) {
        case 'naz':
            arr = arr.sort((a, b) => b.title < a.title);
            break;
        case 'nza':
            arr = arr.sort((a, b) => a.title < b.title);
            break;
        case 'plh':
            arr = arr.sort((a, b) => b.price < a.price);
            break;
        case 'phl':
            arr = arr.sort((a, b) => a.price < b.price);
            break;
        case 'rhl':
            arr = arr.sort((a, b) => a.rating < b.rating);
            break;
        case 'rlh':
            arr = arr.sort((a, b) => a.rating > b.rating);
            break;
        default:
            arr = arr.sort((a, b) => a.title < b.title);
    }
    this.setHtml(arr);
}
