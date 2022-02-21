var count = 60; // dalam detik
function countDown() {
  if (count > 0) {
    count--;
    setTimeout("countDown()", 1000);
    console.log(count);
  }
  else {
    window.location.href = "/logout";
  }
}
countDown();