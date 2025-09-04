<div id="popup" class="popup-overlay">
    <div class="popup-content">
        <h3>🎉 안내</h3>
        <p>{{ Auth::user()->name }}님, 오늘도 좋은 하루 되세요!</p>
        <p>새로운 기능들을 확인해보세요.</p>

        <div class="checkbox-area">
            <input type="checkbox" data-action='hideToday' id="hideToday">
            <label for="hideToday">오늘 하루 보지 않기</label>
        </div>

        <button class="close-btn" data-action='closePopup' >확인</button>
        <button class="close-btn" data-action='closePopup' style="background-color: #6c757d;">닫기</button>
    </div>
</div>
