import React from 'react';
import axios from 'axios';

import StylistItem from './StylistItem';

class SelectStylist extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			listOfStylists: []
		}
	}

	async componentDidMount() {
		const response = await axios.get('/api/stylist');
		const listOfStylists = response.data;

		this.setState({ listOfStylists: listOfStylists });
	}

	render() { 
		const { setStylist, stylist_id } = this.props;
		
		return (
			<div>
				{this.state.listOfStylists.map(stylist => (
					<StylistItem
						key={stylist.id}
						user_id={stylist.user_id}
						profile_photo_url={stylist.profile_photo_url}
						job_title={stylist.job_title}
						introduction={stylist.introduction}
						service={stylist.service}
						user={stylist.user}
						setStylist={setStylist}
						isActive={stylist.id === stylist_id}
					/>
				))}
			</div>
		);
	}

}

export default SelectStylist;

