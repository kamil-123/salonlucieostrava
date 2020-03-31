import React from 'react';
import moment from 'moment';

export default class Calendar extends React.Component {

    state = {
        dateRange: []
    }

    componentDidMount() {
        const dateRange = [moment()];
        for (let index = 1; index <= 14; index++) {
            dateRange.push(moment().add(index, 'days'))
        }
        this.setState({ dateRange })
    }

  render() {
    const { dateRange } = this.state;
    const { setDate } = this.props
    
    if(!dateRange.length) {
        return null;
    }

      return (
          <div>
              <table>
                  <thead>
                      <tr>
                          <th>{dateRange[0].format('dd')}</th>
                          <th>{dateRange[1].format('dd')}</th>
                          <th>{dateRange[2].format('dd')}</th>
                          <th>{dateRange[3].format('dd')}</th>
                          <th>{dateRange[4].format('dd')}</th>
                          <th>{dateRange[5].format('dd')}</th>
                          <th>{dateRange[6].format('dd')}</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td onClick={setDate.bind(this, dateRange[0].toDate())}>{dateRange[0].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[1].toDate())}>{dateRange[1].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[2].toDate())}>{dateRange[2].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[3].toDate())}>{dateRange[3].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[4].toDate())}>{dateRange[4].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[5].toDate())}>{dateRange[5].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[6].toDate())}>{dateRange[6].format('DD')}</td>
                      </tr>
                      <tr>
                          <td onClick={setDate.bind(this, dateRange[7].toDate())}>{dateRange[7].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[8].toDate())}>{dateRange[8].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[9].toDate())}>{dateRange[9].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[10].toDate())}>{dateRange[10].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[11].toDate())}>{dateRange[11].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[12].toDate())}>{dateRange[12].format('DD')}</td>
                          <td onClick={setDate.bind(this, dateRange[13].toDate())}>{dateRange[13].format('DD')}</td>
                      </tr>
                  </tbody>
              </table>
          </div>

      )

  }

}