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




