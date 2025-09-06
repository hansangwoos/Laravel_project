// resources/js/dashboard.js

// 상품관련 전역변수 선언
let cart = [];

// DOMContentLoaded 이벤트로 시작
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard loaded');

    // 초기화 함수들 호출
    initializeCart();
    attachEventListeners();
});

// 함수들은 밖에 정의
function initializeCart() {
    // 초기화 로직

}

function attachEventListeners() {
    // 이벤트 리스너 등록

    // 닫기/확인 이벤트
    document.querySelectorAll('[data-action="closePopup"]').forEach(button => {
        button.addEventListener('click', function(){
            console.log('닫기버튼 클릭');
            closePop();
        });
    });

    const hideTodayBtn = document.querySelector('[data-action="hideToday"]');
    // 오늘 하루 안보기 버튼
    if(hideTodayBtn){
        hideTodayBtn.addEventListener('click',function(){
            setCookie('hideToday', 'true',1);
            closePop();
        });
    }

    // 팝업 다시 보기
    document.querySelector('[data-action="showPopup"]').addEventListener('click',function(){
        setCookie('hideToday', '',-1);
        showPop();
    })

    // 담기 버튼 클릭시 addToCartToDatabase 함수실행
    document.querySelectorAll('[data-action="addToCart"]').forEach(function(button){
        button.addEventListener('click',function(){
            const productId = this.dataset.id;
            console.log(productId);
            addToCartToDatabase(productId);
        })
    })

    // 장바구니 전체삭제
    if(document.querySelector('[data-action="clearCart"]')){
        document.querySelector('[data-action="clearCart"]').addEventListener('click',function(){
            if (confirm("정말로 삭제하시겠습니까?")) { // confirm 결과 체크
                clearCart();
            }
        })
    }

    // 장바구니내  - or + 버튼 클릭시
    if(document.querySelectorAll('.cart-quantity-controls')){
        document.querySelectorAll('.quantity-btn').forEach(function(button){
            var dataAction = button.dataset.action;
            var cartId = button.dataset.id;
            var quantityCount = button.closest('.cart-item').querySelector('.cart-quantity-display').textContent;


            button.addEventListener('click',function(){
                if(dataAction == 'decreaseQuantity'){
                    if(quantityCount == 1 ){
                        if(confirm('1개의 상품은 삭제됩니다. \n정말로 삭제하시겠습니까?')){
                            removeCartItem(cartId);
                        }
                    }else {
                            updateCartItem(cartId,dataAction);
                    }
                }
            })
        })
    }

}


//////////////////////////////////////////////////////////////////////////////////////////
// 함수목록
//////////////////////////////////////////////////////////////////////////////////////////


// 담기 버튼 클릭시 AJAX 로 /cart/add 라우트 호출 => 호출하여 데이터 담기
function addToCartToDatabase(productId){
    fetch('/cart/add', {
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            productId: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            // 장바구니 목록 다시 보여주기
            document.getElementById('cart-section').innerHTML  = data.cartHtml;
        }
    })
    .catch(error => {
        console.error('Error', error);
    })
}

// 팝업 닫기 함수
function closePop(){
    document.getElementById('popup').style.display = 'none';
}

// 팝업 열기 함수
function showPop(){
    document.getElementById('popup').style.display = 'flex';
}

// 쿠키 저장 함수
function setCookie(name, value, exp){
    var date = new Date();
    date.setTime(date.getTime() + exp * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + value + "; expires=" + date.toUTCString() + "; path=/";
}

// 장바구니 전체삭제
function clearCart(){
    fetch('/cart/clear',{
        method: 'DELETE',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            alert('전체 삭제완료');
            document.getElementById('cart-section').innerHTML  = data.cartHtml;
        }
    })
}

// 개별 상품 삭제
function removeCartItem(cartId,quantity){

    fetch('/cart/'+cartId,{
        method: 'DELETE',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            cartId: cartId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            alert('선택하신 상품이 삭제되었습니다');
            document.getElementById('cart-section').innerHTML  = data.cartHtml;
        }
    })
    .catch(error => {
        console.error('Error', error);
    })
}


// - or + 버튼 클릭시 update
function updateCartItem(cartId,action){
    fetch('/cart/'+cartId,{
        method: 'PUT',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            cartId: cartId,
            action: action
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            document.getElementById('cart-section').innerHTML  = data.cartHtml;
        }
    })
    .catch(error => {
        console.error('Error', error);
    })
}

