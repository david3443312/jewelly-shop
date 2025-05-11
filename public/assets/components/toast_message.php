<!-- Toast message cho giỏ hàng -->
<div id="toast-message" style="display:none; position: fixed; right: 30px; bottom: 30px; background: #4CAF50; color: #fff; padding: 16px 28px; border-radius: 8px; font-size: 18px; z-index: 9999; box-shadow: 0 2px 8px rgba(0,0,0,0.15); min-width: 280px; opacity: 0; transition: opacity 0.4s, transform 0.4s; transform: translateY(40px);">
    Thêm vào giỏ hàng thành công!
    <div id="toast-progress" style="height: 4px; background: #FFC107; width: 100%; position: absolute; left: 0; bottom: 0; border-radius: 0 0 8px 8px; transition: width 2.5s linear;"></div>
</div>
<!-- Toast message cho yêu thích -->
<div id="toast-wishlist" style="display:none; position: fixed; right: 30px; bottom: 80px; background: #e91e63; color: #fff; padding: 16px 28px; border-radius: 8px; font-size: 18px; z-index: 9999; box-shadow: 0 2px 8px rgba(0,0,0,0.15); min-width: 280px; opacity: 0; transition: opacity 0.4s, transform 0.4s; transform: translateY(40px);">
    Đã thêm vào danh sách yêu thích!
    <div id="toast-wishlist-progress" style="height: 4px; background: #fff176; width: 100%; position: absolute; left: 0; bottom: 0; border-radius: 0 0 8px 8px; transition: width 2.5s linear;"></div>
</div>
<!-- Toast message loại bỏ sản phẩm -->
<div id="toast-remove" style="display:none; position: fixed; right: 30px; bottom: 130px; background: #f44336; color: #fff; padding: 16px 28px; border-radius: 8px; font-size: 18px; z-index: 9999; box-shadow: 0 2px 8px rgba(0,0,0,0.15); min-width: 280px; opacity: 0; transition: opacity 0.4s, transform 0.4s; transform: translateY(40px);">
    Đã loại bỏ sản phẩm thành công!
    <div id="toast-remove-progress" style="height: 4px; background: #ffcdd2; width: 100%; position: absolute; left: 0; bottom: 0; border-radius: 0 0 8px 8px; transition: width 2.5s linear;"></div>
</div>
<script>
function showToast(type = 'cart') {
    let toast, progress;
    if(type === 'cart') {
        toast = document.getElementById('toast-message');
        progress = document.getElementById('toast-progress');
    } else if(type === 'wishlist') {
        toast = document.getElementById('toast-wishlist');
        progress = document.getElementById('toast-wishlist-progress');
    } else if(type === 'remove') {
        toast = document.getElementById('toast-remove');
        progress = document.getElementById('toast-remove-progress');
    } else {
        return;
    }
    toast.style.display = 'block';
    setTimeout(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(0)';
        progress.style.width = '100%';
        // Reset progress bar
        progress.style.transition = 'none';
        progress.offsetWidth; // force reflow
        progress.style.transition = 'width 2.5s linear';
        progress.style.width = '0%';
    }, 10);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(40px)';
        setTimeout(() => { toast.style.display = 'none'; }, 400);
    }, 2500);
}
</script>