// const dataArray = [{ item: 'Item 1', rating: 3, price: 300.00, title: 'TITLE 1' }, { item: 'Item 2', rating: 4, price: 400, title: 'TITLE 2' }, { item: 'Item 3', rating: 5, price: 700, title: 'TITLE 3' },
// { item: '10x Castrum Marinum Runs', rating: 5, price: 200, title: 'Emerald Weapon' }, { item: 'Castrum Marinum Mount', rating: 4, price: 300.00, title: 'Emerald Mount' },
// { item: "Eden's Promise: Umbra (Savage)", rating: 4, price: 500.00, title: 'E9S' }];
var dataArray = [];
/******************* Object list for product search ************************/
const html = `<div class='grid_container'>
// <a href='item_page.php?itemindex=$item_index_int'> <img class='large_image' src='imgs/test.jpg'> </a>
// <div class='prod_title'>$item_name</div>
// <div class='description'>$item_desc</div>
// <div class='rating'>
//     $stars
// </div>
// <div class='price' id='$item_index-2'>$$item_price</div>
// <span class='cart_wrapper'>
//     <span class='quantity_selector' id='quantity_selector'>
//     <input type='number' id='$item_index' onchange=\"getTotalPrice($item_price, '$item_index', '$item_index-2')\" name='quantity' min='1' size='2' value='0'>
//     </input>
//     </span>
//     <button type='add_to_cart'>Add to Cart</button>
// </span>
// </div>`;
var sortBy = '';
var filterBy = '';

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


function addToDataArray(item_index_int, item_index, item_name,
    item_rating, item_img_dir, item_price, item_desc) {
    // console.log('Hi');
    // this.item_index_int = item_index_int;
    // this.item_index = item_index;
    // this.item_name = item_name;
    // this.item_rating = item_rating;
    // this.item_img_dir = item_img_dir;
    // this.item_price = item_price;
    // this.item_desc = item_desc;
    // dataArray.push({
    //     item_index_int, item_index, item_name,
    //     item_rating, item_img_dir, item_price, item_desc
    // });
    // console.log('test'); 
    // console.log(dataArray);
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
function getParams(sort, filter) {
    const search = window.location.search.split('searchInp=')[1];
    document.getElementById('center_title').innerHTML = '"' + search + '"';
    var arr = dataArray;

    if (sort === '') { sort = this.sortBy }
    this.sortBy = sort;
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

    if (!filter) { filter = this.fiterBy }
    this.fiterBy = filter;

    switch (filter) {
        case '5x+':
            arr = arr.filter(value => value.price >= 500);
            break;
        case '5x-':
            arr = arr.filter(value => value.price < 500);
            break;
        case '3*+':
            arr = arr.filter(value => value.rating > 3);
            break;
        case '3*-':
            arr = arr.filter(value => value.rating <= 3);
            break;
        default: break;
    }

    this.setHtml(arr);
}


    // case '5x-':

    // <a href="javascript:filter('5x+');">Price (High-Low)</a>
    // <a href="javascript:filter('5x-');">Price (Low-High)</a>
    // <a href="javascript:filter('3*+');">Price (Low-High)</a>
    // <a href="javascript:filter('3*-');">Price (Low-High)</a>