import React from 'react';

const Add = () => {
	return (
		<div className="container">
			<form>
			<div className="mb-3">
				<label htmlFor="exampleInputEmail1" className="form-label">First Name</label>
				<input type="text" className="form-control"/>
			</div>
			<div className="mb-3">
				<label htmlFor="exampleInputEmail1" className="form-label">Last Name</label>
				<input type="text" className="form-control"/>
			</div>
			<div className="mb-3">
				<label htmlFor="exampleInputEmail1" className="form-label">Hobby</label>
				<input type="text" className="form-control"/>
			</div>
			<div className="mb-3">
				<label htmlFor="exampleInputEmail1" className="form-label">Tag/s (separated by comma)</label>
				<input type="text" className="form-control"/>
			</div>
			<button type="submit" className="btn btn-primary">Submit</button>
			</form>
		</div>
	);
};

export default Add;