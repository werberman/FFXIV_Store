const dataArray = [{ title: "E9S - Eden's Promise: Umbra (Savage)", rating: 4, price: 500, id: 'id1' },
{ title: "E10S - Eden's Proimise: Litany (Savage)", rating: 5, price: 500, id: 'id2' },
{ title: "E11S - Eden's Promise: Anamorphosis (Savage)", rating: 3, price: 500, id: 'id3' },
{ title: "E12S - Eden's Promise: Eternity (Savage)", rating: 4, price: 500, id: 'id4' }];

const html =
    `<div class="images">
    <img src="https://via.placeholder.com/1015x100">
        <div class="center_title">TOREPLACETITLE</div>
        <div class="bottom_left_title" id="TOREPLACEID2">REPLACEINITIALPRICE</div>
        <button class="bottom_left_cart">Add to Cart</button>
        <div class="quantity_selector">
            <input type="number" id="TOREPLACEID1" onchange="getTotalPrice(TOREPLACEPRICE, 'TOREPLACEID1', 'TOREPLACEID2')" name="quantity" min="1" size="2" value="0">
            </input>
            </div>
            <div class="raiting">
                TOREPLACESTARS
        </div>
    </img>
</div>`

setTimeout(() => { setHtml() }, 50);

/************** Main replacement funtion ******************/
function setHtml(arr) {
    if (!arr) { arr = dataArray; }
    const template = document.getElementById('template');
    var fullHtml = '';
    arr.forEach(value => {
        fullHtml += html.replace('TOREPLACEPRICE', value.price)
            .replace('TOREPLACESTARS', setStars(value.rating))
            .replace('TOREPLACETITLE', value.title)
            .replace('REPLACEINITIALPRICE', "$" + value.price + ".00")
            //doubled to account for the fact that it will only replace the first instance if not repeated.
            .replace('TOREPLACEID1', value.id)
            .replace('TOREPLACEID1', value.id)
            .replace('TOREPLACEID2', value.id + "_2")
            .replace('TOREPLACEID2', value.id + "_2");
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