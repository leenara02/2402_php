import axios from 'axios';

const axiosInstance = axios.create({
    // 기본 URL 설정
    // baseURL: 'http://112.222.157.156:6006',

    // 기본 헤더 설정 (디폴트 textHTML을 JSON으로 변경)
    headers: {
        'Content-Type': 'application/json' // 주고받을데이터가 제이슨이다.를 명시
    }
});

export default axiosInstance;