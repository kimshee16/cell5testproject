import React from 'react';
import { Link } from "react-router-dom";
import { useEffect, useState } from 'react';
import api from '../api';

const Home = () => {
	const [hobbies, setHobbies] = useState(null); 

	useEffect(() => {
		api.getAllHobbies().then(res => {
			 const result = res.data;
			 setHobbies(result.data)
		});
	}, []);

	const renderHobbies = () => {
		if(!hobbies){
			return (
				<tr>
					<td colSpan="4">
						Loading posts...
					</td>
				</tr>
			);
		}
		if(hobbies.length == 0){
			return (
				<tr>
					<td colSpan="4">
						There is no post yet. Add one.
					</td>
				</tr>
			);
		}
		return hobbies.map((hobbies) => (
			<tr>
				<td>{hobbies.firstname}</td>
				<td>{hobbies.lastname}</td>
				<td>{hobbies.hobbies}</td>
				<td>{hobbies.tags}</td>
				<td>
					<Link
						className="btn btn-warning"
						to={`/hobbies/edit/${hobbies.id}`}
					>
						Edit
					</Link>
					<Link
						className="btn btn-danger"
						to={`/hobbies/delete/${hobbies.id}`}
					>
						Delete
					</Link>
				</td>
			</tr>
		));
	}

	return (
		<div className="container">
			<div className="card">
			<h5 className="card-header">Cell 5 - Laravel Mix Test</h5>
				<div className="card-body">
					<Link to="/add" className="btn btn-primary">Add Record</Link>
					<div className="table-responsive">
						<table className="table table-stripped mt-4">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Hobby</th>
									<th>Tags</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
									{renderHobbies()}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	);
};

export default Home;