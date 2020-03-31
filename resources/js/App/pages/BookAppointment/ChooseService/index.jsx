import React from 'react';

class ChooseService extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			listOfServices: []
		}
	}

	async componentDidMount() {
		// const response = await axios.get('/api/');
		// const listOfServices = response.data;

		this.setState({ listOfServices: [listOfServices] });
	}


	render() {
		return (
			<div>
				CHOSEE SERVICE STRANICA
			</div>
		);
	}

}

export default ChooseService;

