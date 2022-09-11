import { useEffect, useState } from "react";


const Leaderboard = () => {
    const [users, setusers] = useState([]);
    const url = "http://localhost:8000/api/leaderboard";
    useEffect(() => {
        async function fetchData() {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw Error();
                }
                const data = await response.json();
                console.log(data);
                setusers(data.users);
            } catch (e) {
                console.log(e);
            }
        };
        fetchData();
    }, [url]);
    return (<table>
        <tr>
            <th>Username</th>
            <th>Task Count</th>
        </tr>
        {users.length > 0 ? users.map(user => {
            return (<tr key={user.id}>
                <td>{user.name}</td>
                <td>{user.tasks_count}</td>
            </tr>)

        }) : (<tr>
            <td>-</td>
            <td>-</td>
        </tr>)}
    </table>);
};

export default Leaderboard;