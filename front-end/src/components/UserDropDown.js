import { useEffect, useState } from "react";


const UserDropDown = (props) => {
    const [users, setusers] = useState([]);
    const url = "http://localhost:8000/api/user/users";
    useEffect(() => {
        async function fetchData() {
            try {
                const response = await fetch("http://localhost:8000/api/user/users");
                if (!response.ok) {
                    throw Error();
                }
                const data = await response.json();
                console.log(data);
                setusers(data.data);
            } catch (e) {
                console.log(e);
            }
        };
        fetchData();
    }, [url]);
    return (<select name="users" id="users" onChange={function (e) { props.assignedToIdState(e.target.value) }} >{users.length > 0 ? users.map(user => {
        return (<option id={user.id} value={user.id}>{user.name}</option>)
    }) : (<option>empty</option>)}</select>);
};

export default UserDropDown;