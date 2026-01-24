import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default function (to, from, next) {
    var token = localStorage.getItem("key_admin");
    if (!token) {
        toaster.error("Vui lòng đăng nhập");
        next("/admin/dang-nhap");
        return;
    }
    axios
        .get("http://127.0.0.1:8000/api/admin/check-token", {
            headers: {
                Authorization: "Bearer " + token,
            },
        })
        .then((res) => {
            if (res.data.status) {
                localStorage.setItem("admin_name", res.data.name);
                localStorage.setItem("admin_email", res.data.email);
                next();
            } else {
                toaster.error(res.data.message);
                next("/admin/dang-nhap");
            }
        })
        .catch((error) => {
            console.error('Lỗi check admin token:', error);
            toaster.error("Không thể xác minh token");
            next("/admin/dang-nhap");
        });
}