import { useEffect, useState } from "react";


const AdminDropDown = (props) => {
    const [admins, setAdmins] = useState([]);
    const url = "http://localhost:8000/api/user/admins";
    useEffect(() => {
        async function fetchData() {
            try {
                const response = await fetch("http://localhost:8000/api/user/admins");
                if (!response.ok) {
                    throw Error();
                }
                const data = await response.json();
                console.log(data);
                setAdmins(data.data);
            } catch (e) {
                console.log(e);
            }
        };
        fetchData();
    }, [url]);
    return (<select name="admins" id="admins" onChange={function (e) {props.assignedByIdState(e.target.value)}} >{admins.length > 0 ? admins.map(admin => {
        return (<option id={admin.id} value={admin.id}>{admin.name}</option>)
    }) : (<option>empty</option>)}</select>);
};

export default AdminDropDown;