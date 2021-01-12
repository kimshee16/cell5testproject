import React from 'react';
import ReactDOM from 'react-dom';
import {
	BrowserRouter as Router,
	Switch,
	Route
} from "react-router-dom";
import Home from "./components/Home";
import Add from "./components/Add";
import Edit from "./components/Edit";
import Wiki from "./components/Wiki";

const App = () => {
	return (
		<Router className="App_container">
			<Switch>
				<Route exact path="/">
					<Home />
				</Route>
				<Route exact path="/add">
					<Add />
				</Route>
				<Route exact path="/edit/:id">
					<Edit />
				</Route>
				<Route exact path="/wiki/:id">
					<Wiki />
				</Route>
			</Switch>
		</Router>
	);
};

export default App;

if (document.getElementById('app')) {
	ReactDOM.render(<App />, document.getElementById('app'));
}