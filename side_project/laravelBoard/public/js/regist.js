document.querySelector('#btn-chk-email').addEventListener('click', chkEmail);

async function chkEmail() {
    try {
        const email = document.querySelector('#email').value;
        const url = '/user/chk';
    
        // form 생성
        const form = new FormData();
        form.append('email', email);
    
        // ajax
        const response = await axios.post(url, form);
            const btnComplete = document.querySelector('#my-btn-complete'); 
            const printChkEmail = document.querySelector('#print-chk-email');
            printChkEmail.innerHTML = '';
            // 정상처리
            if(response.data.emailFlg) {
                // 중복 이메일
            printChkEmail.innerHTML = '중복된 이메일';
            printChkEmail.classList = 'text-danger';
            btnComplete.setAttribute('disabled', 'disabled');

            } else {
                // 사용가능 이메일
            printChkEmail.innerHTML = '사용 가능';
            printChkEmail.classList = 'text-success';
            btnComplete.removeAttribute('disabled');
            }
        
    } catch (error) {
        console.log(error);
        alert('이메일 확인해주세요');
    }
}

