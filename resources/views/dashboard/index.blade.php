<!DOCTYPE html>
<html>
<head>
    <title>대시보드</title>
    @vite(['resources/css/dashboard.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- 네비게이션 -->
    <nav class="navbar">
        <div class="nav-container">
            <h1 class="nav-title">My Dashboard</h1>
            <div class="nav-user">
                <span class="welcome-text">환영합니다, {{ Auth::user()->name }}님! 👋</span>
                <form method="POST" action="/logout" class="logout-form">
                    <button type="submit" class="logout-btn">로그아웃</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- 메인 컨텐츠 -->
    <div class="container">
        <!-- 대시보드 카드들 -->
        <div class="dashboard-grid">
            <!-- 장바구니 카드 -->
            <div class="card">
                <div class="card-header">
                    <h3>🛒 장바구니</h3>
                </div>
                <div class="card-body" id='cart-section'>
                    @include('dashboard.partials.cart-section')
                </div>
            </div>

            <!-- 상품 목록 카드 -->
            <div class="card">
                <div class="card-header">
                    <h3>📦 상품 목록</h3>
                </div>
                <div class="card-body">
                        @include('dashboard.partials.product-section')
                    </div>
                </div>
            </div>

            <!-- 최근 활동 카드 -->
            <div class="card">
                <div class="card-header">
                    <h3>📈 최근 활동</h3>
                </div>
                <div class="card-body">
                    <ul class="activity-list">
                        <li>✅ 로그인 성공</li>
                        <li>🛒 상품 장바구니에 추가됨</li>
                        <li>🔔 새로운 알림 1개</li>
                    </ul>
                </div>
            </div>

            <!-- 설정 카드 -->
            <div class="card">
                <div class="card-header">
                    <h3>⚙️ 설정</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-outline">프로필 수정</button>
                    <button class="btn btn-outline">알림 설정</button>
                    <button class="btn btn-outline" data-action='showPopup'>팝업 다시 보기</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 팝업 (쿠키 체크) -->
    @if(empty($_COOKIE['hideToday']))
        @include('dashboard.popup')
    @endif

    <!-- 장바구니 모달 -->
    <div id="cart-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>🛒 장바구니</h3>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div id="cart-items">
                    <!-- 장바구니 아이템들이 여기에 추가됩니다 -->
                </div>
                <div class="cart-total">
                    <strong>총 금액: ₩<span id="total-price">0</span></strong>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="clearCart()">전체 삭제</button>
                <button class="btn btn-primary">주문하기</button>
            </div>
        </div>
    </div>
    @vite([ 'resources/js/dashboard.js'])
</body>
</html>
