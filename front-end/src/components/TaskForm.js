import React, { useRef, useState } from "react";
import AdminDropDown from "./AdminDropDown";
import UserDropDown from "./UserDropDown";

const TaskForm = () => {
    const [assignedById, assignedByIdState] = useState(null);
    const [assignedToId, assignedToIdState] = useState(null);

    const title = useRef();
    const description = useRef();
    const noErrorRef = useRef();
    const ErrorRef = useRef();

    const fromSubmit = async (event) => {
        event.preventDefault();
        const Body = {
            "assigned_by_id" : assignedById,
            "assigned_to_id": assignedToId,
            title: title.current.value,
            description: description.current.value
        };
        try {
            const response = await fetch("http://localhost:8000/api/task", {
                method: "POST",
                body: JSON.stringify(Body),
                headers: {
                    "content-type": "application/json",
                },
            });
            console.log("data", Body);
            console.log(response.status);
            if (response.ok) {
                const finalRes = await response.json();
                if (finalRes.errors) {
                    ErrorRef.current.innerHTML = "Something went Wrong";
                }
                if (finalRes.data) {
                    noErrorRef.current.innerHTML = "user Created Succesfully ";
                }
            }
        } catch (err) {
            console.log(err);
            ErrorRef.current.innerHTML = `${err}`;
        }
    };

    return (
        <form className="create-form" onSubmit={fromSubmit}>
            <AdminDropDown assignedByIdState = {assignedByIdState}/> <br />
            <UserDropDown assignedToIdState = {assignedToIdState}/> <br />
            <input
                type="text"
                id="title"
                placeholder="title"
                required
                ref={title}
            /><br />
            <textarea id="description" placeholder="description" required ref={description} /><br />
            <p ref={noErrorRef}> </p>
            <p ref={ErrorRef}></p>
            <button type="submit">create task</button>
        </form>
    );
};

export default TaskForm;